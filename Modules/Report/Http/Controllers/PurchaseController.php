<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\LocationRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use Modules\Procurement\Dao\Repositories\SupplierRepository;
use Modules\Report\Dao\Repositories\ReportPurchaseDetail;
use Modules\Report\Dao\Repositories\ReportPurchaseSummary;
use Modules\Report\Dao\Repositories\ReportWoDetail;
use Modules\Report\Dao\Repositories\ReportWoSummary;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Views;

class PurchaseController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $supplier = Views::option(new SupplierRepository());

        $view = [
            'location' => $location,
            'product' => $product,
            'supplier' => $supplier,
        ];

        return array_merge($view, $data);
    }

    public function detail(ReportPurchaseDetail $repository)
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

    public function detailExport(ReportService $service, ReportPurchaseDetail $repository)
    {
        return $service->generate($repository, 'export_detail');
    }

    public function summary(ReportPurchaseSummary $repository)
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

    public function summaryExport(ReportService $service, ReportPurchaseSummary $repository)
    {
        return $service->generate($repository, 'export_summary');
    }
}
