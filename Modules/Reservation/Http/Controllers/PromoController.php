<?php

namespace Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Reservation\Dao\Enums\PromoType;
use Modules\Reservation\Dao\Repositories\PromoRepository;
use Modules\Reservation\Http\Requests\PromoRequest;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class PromoController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(PromoRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $city = $area = [];
        $province = DB::table('rajaongkir_provinces')->get()
        ->pluck('rajaongkir_province_name', 'rajaongkir_province_id')
        ->prepend('- Select Province -','');

        $view = [
            'province' => $province,
            'city' => $city,
            'area' => $area
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
        return view(Views::create())->with($this->share());
    }

    public function save(PromoRequest $request, CreateService $service)
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

    public function edit($code)
    {
        $model = $this->get($code);

        $area = $city = [];

        $province_data = request()->get('customer_province') ?? $model->customer_province ?? null;
        if($province_data){

            $city = DB::table('rajaongkir_cities')
            ->where('rajaongkir_city_province_id', $province_data)
            ->get()->pluck('rajaongkir_city_name', 'rajaongkir_city_id');
        }

        $city_data = request()->get('customer_city') ?? $model->customer_city ?? null;
        if($city_data){

            $area = DB::table('rajaongkir_areas')->where('rajaongkir_area_city_id', $city_data)
            ->pluck('rajaongkir_area_name','rajaongkir_area_id')->prepend('- Select Area -');
        }

        return view(Views::update())->with($this->share([
            'model' => $model,
            'city' => $city,
            'area' => $area,
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
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
