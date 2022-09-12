<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\LocationRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Procurement\Dao\Enums\RequestStatus;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use Modules\Procurement\Dao\Repositories\SupplierRepository;
use Modules\Report\Dao\Repositories\ReportPurchaseDetail;
use Modules\Report\Dao\Repositories\ReportPurchaseSummary;
use Modules\Report\Dao\Repositories\ReportRequestDetail;
use Modules\Report\Dao\Repositories\ReportRequestSummary;
use Modules\Report\Dao\Repositories\ReportWoDetail;
use Modules\Report\Dao\Repositories\ReportWoSummary;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Views;

class RequestController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $status = RequestStatus::getOptions();

        $view = [
            'product' => $product,
            'status' => $status,
        ];

        return array_merge($view, $data);
    }

    public function detail(ReportRequestDetail $repository)
    {
        $preview = false;
        if ($name = request()->get('name')) {
            $preview = $repository->generate($name)->data();
        }
        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'preview' => $preview,
            ]));
    }

    public function detailExport(ReportService $service, ReportRequestDetail $repository)
    {
        return $service->generate($repository, 'export_detail');
    }

    public function summary(ReportRequestSummary $repository)
    {
        $preview = false;
        if ($name = request()->get('name')) {
            $preview = $repository->generate($name)->data();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'preview' => $preview,
            ]));
    }

    public function summaryExport(ReportService $service, ReportRequestSummary $repository)
    {
        return $service->generate($repository, 'export_summary');
    }
}
