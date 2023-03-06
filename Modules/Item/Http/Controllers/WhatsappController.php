<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Enums\WaStatus;
use Modules\Item\Dao\Enums\WhatsappType;
use Modules\Item\Dao\Repositories\TemplateRepository;
use Modules\Item\Dao\Repositories\WhatsappRepository;
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

class WhatsappController extends Controller
{
    public static $Whatsapp;
    public static $service;
    public static $model;

    public function __construct(WhatsappRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $view = [
            'templates' => Views::option(new TemplateRepository()),
            'user' => Views::option(new TeamRepository()),
            'status' => WaStatus::getOptions(),
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
            ->EditStatus([
                'wa_status' => WaStatus::class,
            ])
            ->EditAction([
                'page'      => config('page'),
                'folder'    => config('folder'),
            ])
            ->make();
    }

    public function edit($code)
    {
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $wa = $this->get($code, ['has_template']);

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
