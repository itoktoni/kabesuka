<?php

namespace Modules\Item\Http\Services;

use Modules\Item\Dao\Models\EquipmentDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class EquipmentUpdateService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        EquipmentDetail::create([
            'equipment_detail_type' => $data->get('equipment_status'),
            'equipment_detail_description' => $data->get('equipment_detail_description'),
            'equipment_detail_stock_old' => $data->get('equipment_detail_stock_old'),
            'equipment_detail_stock_new' => $data->get('equipment_stock'),
        ]);

        if (isset($check['status']) && $check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
