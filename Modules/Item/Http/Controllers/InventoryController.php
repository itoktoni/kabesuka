<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Item\Dao\Models\Inventory;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Repositories\InventoryRepository;
use Modules\Item\Dao\Repositories\ReportInventory;
use Modules\Item\Http\Services\InventoryCreateService;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class InventoryController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(InventoryRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $last = $database = [];

        $detail = Product::where('product_warehouse', 1)->orderBy('product_name', 'ASC')->get();

        if ($date = request()->get('date')) {

            $type = request()->get('type') == 'MLM' ? 'MLM' : 'PGI';
            $reverse = request()->get('type') == 'MLM' ? 'PGI' : 'MLM';

            $tgl = request()->get('type') == 'PGI' ? Carbon::parse($date)->subDay(1)->format('Y-m-d') : $date;

            $database = Product::where('product_warehouse', 1)
                ->leftJoinRelationship('has_inventory')
                ->addSelect('inventory.*')
                ->where('inventory_date', $date)
                ->orderBy('product_name', 'ASC')
                ->get()
                ->mapWithKeys(function($item){
                    return [$item->product_id => $item];
                });

            $last = Product::where('product_warehouse', 1)
                ->joinRelationship('has_inventory')
                ->addSelect('inventory.*')
                // ->where('inventory_type', $reverse)
                ->where('inventory_date', $tgl)
                ->orderBy('product_name', 'ASC')
                ->get()
                ->mapWithKeys(function($item){
                    return [$item->product_id => $item];
                });
        }

        $view = [
            'database' => $database,
            'detail' => $detail,
            'last' => $last,
        ];

        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create(ReportInventory $repository, ReportService $service)
    {
        if (request()->get('action') == 'excel') {
            return $service->generate($repository, 'export');
        }

        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, InventoryCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->make();
    }

    public function edit($code, ReportInventory $repository, ReportService $service)
    {
        if (request()->get('action') == 'excel') {
            return $service->generate($repository, 'export');
        }

        $detail = Product::where('product_warehouse', 1)
            ->leftJoinRelationship('has_inventory')
            ->addSelect('inventory.*')
            ->where('inventory_code', $code)
            ->orderBy('product_name', 'ASC')
            ->get();

        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
            'detail' => $detail,
        ]));
    }

    public function update($code, GeneralRequest $request, InventoryCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
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

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
