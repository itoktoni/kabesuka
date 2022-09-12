<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Models\Shift;
use Modules\Item\Dao\Repositories\LocationRepository;
use Modules\Report\Dao\Repositories\ReportJadwalDetail;
use Modules\Report\Dao\Repositories\ReportStockDetail;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Views;

class JadwalController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $location = Views::option(new LocationRepository());
        $view = [
            'location' => $location,
        ];

        return array_merge($view, $data);
    }

    public function detail(ReportJadwalDetail $repository)
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

    public function detailExport(ReportService $service, ReportJadwalDetail $repository)
    {
        return $service->generate($repository, 'export_detail');
    }
}
