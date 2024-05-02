<?php

namespace Modules\Item\Http\Services;

use Carbon\Carbon;
use Modules\Item\Dao\Models\Inventory;
use Modules\Procurement\Dao\Facades\StockFacades;
use Modules\Procurement\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;

class InventoryCreateService extends UpdateService
{
    public function save(CrudInterface $repository, $data)
    {
        $date = Carbon::make($data->date)->format('Ymd');
        $code = $date;

        $inventory = [];

        foreach($data->detail as $item){
            if($data->type == 'PGI'){
                $merge = [
                    'awal_pagi' => $item['temp_awal'],
                    'masuk_pagi' => $item['temp_masuk'],
                    'akhir_pagi' => $item['temp_akhir'],
                    'keluar_pagi' => ($item['temp_awal'] + $item['temp_masuk']) - $item['temp_akhir'],
                ];
            }
            else {
                $merge = [
                    'awal_malam' => $item['temp_awal'],
                    'masuk_malam' => $item['temp_masuk'],
                    'akhir_malam' => $item['temp_akhir'],
                    'keluar_malam' => ($item['temp_awal'] + $item['temp_masuk']) - $item['temp_akhir'],
                ];
            }

            $key = [
                'inventory_code' => $code,
                'inventory_product_id' => $item['temp_id'],
                'inventory_date' => $data->date,
                'inventory_type' => $data->type,
            ];

            $inventory[] = array_merge($key, $merge);

            // Inventory::updateOrCreate($key, $inventory);
        }

        Inventory::upsert($inventory, ['inventory_code', 'inventory_product_id', 'inventory_date']);
        $check = true;

        if (isset($check) && $check) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
