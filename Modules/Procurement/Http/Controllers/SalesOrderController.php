<?php

namespace Modules\Procurement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\Finance\Dao\Enums\PaymentMethod;
use Modules\Finance\Dao\Enums\PaymentStatus;
use Modules\Finance\Dao\Repositories\BankRepository;
use Modules\Finance\Dao\Repositories\PaymentRepository;
use Modules\Item\Dao\Repositories\CategoryMakananRepository;
use Modules\Item\Dao\Repositories\CategoryRepository;
use Modules\Item\Dao\Repositories\LocationRepository;
use Modules\Item\Dao\Repositories\MakananRepository;
use Modules\Item\Dao\Repositories\MejaRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Procurement\Dao\Enums\SalesPayment;
use Modules\Procurement\Dao\Enums\SalesStatus;
use Modules\Procurement\Dao\Enums\SupplierPph;
use Modules\Procurement\Dao\Enums\SupplierPpn;
use Modules\Procurement\Dao\Enums\SupplierType;
use Modules\Procurement\Dao\Facades\BranchFacades;
use Modules\Procurement\Dao\Facades\PoDetailFacades;
use Modules\Procurement\Dao\Facades\PoReceiveFacades;
use Modules\Procurement\Dao\Models\PoReceive;
use Modules\Procurement\Dao\Repositories\BranchRepository;
use Modules\Procurement\Dao\Repositories\SalesRepository;
use Modules\Procurement\Dao\Repositories\SupplierRepository;
use Modules\Procurement\Http\Requests\PaymentRequest;
use Modules\Procurement\Http\Requests\SalesReceiveRequest;
use Modules\Procurement\Http\Requests\SalesRequest;
use Modules\Procurement\Http\Services\DeleteSalesService;
use Modules\Procurement\Http\Services\DeleteReceiveService;
use Modules\Procurement\Http\Services\SalesCreateService;
use Modules\Procurement\Http\Services\SalesReceiveService;
use Modules\Procurement\Http\Services\SalesUpdateService;
use Modules\Reservation\Dao\Enums\PaymentType;
use Modules\Reservation\Dao\Repositories\CustomerRepository;
use Modules\System\Dao\Enums\GroupUserType;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use PDF;

class SalesOrderController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(SalesRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        // $supplier = Views::option(new SupplierRepository(), false, true)->mapWithKeys(function ($item) {
        //     $pph = '';
        //     if ($item->mask_pph) {
        //         $pph = ' (' . strtoupper(SupplierPph::getDescription($item->mask_pph)) . ')';
        //     }
        //     $data[$item->supplier_id] = $item->supplier_name . ' - ' . strtoupper(SupplierPpn::getDescription($item->supplier_ppn)) . $pph;
        //     return $data;
        // })->prepend('- Select Supplier -', '')->toArray();

        $customer = Views::option(new TeamRepository());
        $category = Views::option(new CategoryMakananRepository());
        $location = Views::option(new LocationRepository());
        $product = Views::option(new MakananRepository());
        $table = Views::option(new MejaRepository());
        $payment = PaymentType::getOptions();

        $view = [
            'table' => $table,
            'product' => $product,
            'payment' => $payment,
            'location' => $location,
            'category' => $category,
            'customer' => $customer,
            'model' => self::$model,
        ];
        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        $status = [SalesStatus::Create => SalesStatus::getDescription(SalesStatus::Create)];
        return view(Views::create(config('page'), config('folder')))->with($this->share([
            'status' => $status,
        ]));
    }

    public function save(SalesRequest $request, SalesCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditStatus([
                self::$model->mask_status() => SalesStatus::class,
            ])->EditColumn([
                self::$model->mask_dpp() => 'mask_dpp_format',
                self::$model->mask_pph() => 'mask_pph_format',
                self::$model->mask_ppn() => 'mask_ppn_format',
                'po_updated_at' => 'po_updated_at',
                self::$model->mask_total() => 'mask_total_rupiah',
            ])->EditAction([
                'page'      => config('page'),
                'folder'    => config('folder'),
            ])->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);

        $status = SalesStatus::getOptions();
        if (auth()->user()->group_user != GroupUserType::Developer) {
            $status = [$data->mask_status => SalesStatus::getDescription($data->mask_status)];
        }

        return view(Views::update(config('page'), config('folder')))->with($this->share([
            'model' => $data,
            'status' => $status,
            'detail' => $data->has_detail,
        ]));
    }

    public function update($code, SalesRequest $request, SalesUpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $data = $this->get($code);
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $data,
            'detail' => $data->detail ?? []
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteSalesService $service)
    {
        $data = [];
        $master = $request->get('master');
        $code = $request->get('code');

        if ($request->has('transaction')) {
            $data = $service->deleteTransaction(self::$model, $master, $code);
        }
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }

    public function formPayment($code)
    {
        $data = $this->get($code);
        $supplier = $data->has_supplier;
        $bank = Views::option(new BankRepository(), false, true)
            ->pluck('bank_name', 'bank_name')->prepend('- Select Bank - ', '')->toArray();

        $method = PaymentMethod::getOptions();

        return view(Views::form(Helper::snake(__FUNCTION__), config('page'), config('folder')))
            ->with($this->share([
                'model' => $data,
                'bank' => $bank,
                'method' => $method,
                'supplier' => $supplier,
                'payment' => PaymentStatus::class,
                'detail' => $data->has_payment ?? false
            ]));
    }

    public function postPayment(PaymentRequest $request, CreateService $service, PaymentRepository $repository)
    {
        $data = $service->save($repository, $request);
        return Response::redirectBack($data);
    }

    public function formReceive($code)
    {
        $data = $this->get($code);
        $product = Views::option(new ProductRepository());

        $status = SalesStatus::getOptions();
        if (auth()->user()->group_user != GroupUserType::Developer) {
            $status = [$data->mask_status => SalesStatus::getDescription($data->mask_status)];
        }

        return view(Views::form(Helper::snake(__FUNCTION__), config('page'), config('folder')))
            ->with($this->share([
                'model' => $data,
                'detail' => $data->has_detail,
                'product' => $product,
                'status' => $status,
            ]));
    }

    public function postReceive(SalesReceiveRequest $request, SalesReceiveService $service)
    {
        $data = $service->update(self::$model, $request, request()->get('code'));
        return Response::redirectBack($data);
    }

    public function formReceiveDetail($code)
    {
        $data_branch = BranchFacades::find(env('BRANCH_ID'));
        $branch = [];
        if ($data_branch) {
            $branch[$data_branch->{$data_branch->getKeyName()}] = $data_branch->mask_name;
        }
        $detail = request()->get('detail');

        $receive = PoReceive::with(['has_branch'])->where(PoReceiveFacades::mask_po_code(), $code)
            ->where(PoReceiveFacades::mask_product_id(), $detail)->get();

        $model = $receive->first();

        $po = $this->get($code, ['has_supplier']);

        if (empty($model)) {

            $model = PoDetailFacades::where(PoDetailFacades::mask_po_code(), $code)
                ->where(PoDetailFacades::mask_product_id(), request()->get('detail'))->firstOrFail();

            $master = $model->has_master;
            $supplier = $po->has_supplier;

            $data = [
                'purchase_date' => $master->po_date_order ?? null,
                'purchase_status' => $master->po_status ?? '',
                'purchase_supplier' => $supplier ? $supplier->supplier_name . ' - ' . strtoupper(SupplierPpn::getDescription($supplier->supplier_ppn)) : '',
                'purchase_notes' => $master->po_notes ?? '',
                'purchase_product_name' => $model->has_product->mask_name ?? '',
                'po_receive_date' => date('Y-m-d'),
                'po_receive_po_code' => $code,
                'po_receive_product_id' => $detail,
                'po_receive_supplier_id' => $master->po_supplier_id ?? null,
                'po_receive_type' => $model->has_product->has_category->category_type ?? null,
                'po_receive_qty' => $model->po_detail_qty,
                'po_receive_receive' => null,
                'po_receive_start' => null,
                'po_receive_end' => null,
                'po_receive_buy' => $model->po_detail_price,
                'po_receive_sell' => 0,
            ];

            $model = array_merge($model->toArray(), $data);
        } else {

            $master = $model->has_master;
            $supplier = $po->has_supplier;

            $data = [
                'purchase_product_name' => $model->has_product->mask_name ?? '',
                'purchase_date' => $master->po_date_order ?? null,
                'purchase_status' => $master->po_status ?? '',
                'purchase_supplier' => $supplier->supplier_name . ' - ' . strtoupper(Supplierppn::getDescription($supplier->supplier_ppn)) ?? '',
                'purchase_notes' => $master->po_notes ?? '',
            ];

            $model = array_merge($model->toArray(), $data);
        }

        return view(Views::form(Helper::snake(__FUNCTION__), config('page'), config('folder')))
            ->with($this->share([
                'model' => (object) $model,
                'branch' => $branch,
                'detail' => $receive,
            ]));
    }

    public function postReceiveDetail(SalesReceiveRequest $request, SalesReceiveService $service, PoReceive $receive)
    {
        $data = $service->save($receive, $request);
        return Response::redirectBack($data);
    }

    public function showReceiveDetail($code)
    {
        $model = PoReceiveFacades::with(['has_detail', 'has_detail.has_product', 'has_detail.has_supplier'])->findOrFail($code);

        return view(Views::form(Helper::snake(__FUNCTION__), config('page'), config('folder')))
            ->with($this->share([
                'model' => $model,
                'detail' => $model->has_detail ?? false,
            ]));
    }

    public function deleteReceiveDetail($code, DeleteReceiveService $service)
    {
        $check = $service->delete($code);
        return Response::redirectBack();
    }

    public function printOrder($code)
    {
        $data = $this->get($code);
        $pdf = PDF::loadView(Views::pdf(config('page'), config('folder'), 'print_order'), [
            'master' => $data
        ]);
        return $pdf->stream();
    }

    public function printInvoice($code)
    {
        $data = $this->get($code, ['has_detail']);
        $pdf = PDF::loadView(Views::pdf(config('page'), config('folder'), 'print_invoice'), [
            'master' => $data,
            'detail' => $data->has_detail
        ])->setPaper(array( 0 , 0 , 226 , 380 ));;

        return $pdf->stream();
    }
}
