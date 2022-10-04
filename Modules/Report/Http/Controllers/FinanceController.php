<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Procurement\Dao\Enums\PurchaseStatus;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use Modules\Procurement\Dao\Repositories\SupplierRepository;
use Modules\Report\Dao\Repositories\ReportBookingFinance;
use Modules\Report\Dao\Repositories\ReportPurchaseFinance;
use Modules\Report\Dao\Repositories\ReportPurchaseSummary;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Views;

class FinanceController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $user = Views::option(new TeamRepository());
        $product = Views::option(new ProductRepository());
        $customer = Views::option(new TeamRepository());
        $supplier = Views::option(new SupplierRepository());
        $status = PurchaseStatus::getOptions();
        $booking = array_merge(['' => 'Semua Status'], BookingType::getOptions());

        $view = [
            'supplier' => $supplier,
            'product' => $product,
            'customer' => $customer,
            'user' => $user,
            'status' => $status,
            'booking' => $booking,
        ];

        return array_merge($view, $data);
    }

    public function booking(ReportBookingFinance $repository)
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

    public function bookingExport(ReportService $service, ReportBookingFinance $repository)
    {
        return $service->generate($repository, 'export_booking');
    }

    public function purchase(ReportPurchaseSummary $repository)
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

    public function purchaseExport(ReportService $service, ReportPurchaseSummary $repository)
    {
        return $service->generate($repository, 'export_purchase');
    }
}
