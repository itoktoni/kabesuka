<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Enums\ShiftType;
use Modules\Item\Dao\Models\Jadwal;
use Modules\Item\Dao\Repositories\ShiftRepository;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Repositories\TeamRepository;
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

class ShiftController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(ShiftRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $user = TeamFacades::where('group_user', '!=', 'customer')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        });
        $view = [
            'user' => $user
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

    public function save(GeneralRequest $request, CreateService $service)
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
        $user = Jadwal::where('jadwal_shift_id', $model->shift_id)
        ->select('jadwal_user_id')
        ->get();
        return view(Views::update())->with($this->share([
            'model' => $model,
            'users' => $user->pluck('jadwal_user_id')->toArray() ?? [],
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
