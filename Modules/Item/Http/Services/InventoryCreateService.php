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

                $temp_awal = $item['temp_awal'] ?? 0;
                $temp_masuk = $item['temp_masuk'] ?? 0;
                $temp_akhir = $item['temp_akhir'] ?? 0;
                $temp_awal = $item['temp_awal'] ?? 0;

                $merge = [
                    'awal_pagi' => $temp_awal,
                    'masuk_pagi' => $temp_masuk,
                    'akhir_pagi' => $temp_akhir,
                    'keluar_pagi' => ($temp_awal + $temp_masuk) - $temp_akhir,
                ];
            }
            else {

                $temp_awal = $item['temp_awal'] ?? 0;
                $temp_masuk = $item['temp_masuk'] ?? 0;
                $temp_akhir = $item['temp_akhir'] ?? 0;
                $temp_awal = $item['temp_awal'] ?? 0;

                $merge = [
                    'awal_malam' => $temp_awal,
                    'masuk_malam' => $temp_masuk,
                    'akhir_malam' => $temp_akhir,
                    'keluar_malam' => ($temp_awal + $temp_masuk) - $temp_akhir,
                ];
            }

            $key = [
                'inventory_code' => $code,
                'inventory_product_id' => $item['temp_id'],
                'inventory_date' => $data->date,
                'inventory_type' => $data->type,
            ];

            $inventory = array_merge($key, $merge);

            $save = Inventory::where('inventory_code', $code)
                ->where('inventory_product_id', $item['temp_id'])
                ->where('inventory_date', $data->date)->count();

            if($save > 0){
                Inventory::where('inventory_code', $code)
                ->where('inventory_product_id', $item['temp_id'])
                ->where('inventory_date', $data->date)
                ->update($inventory);
            }
            else{
                Inventory::create($inventory);
            }
        }

        $check = true;

        if (isset($check) && $check) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
