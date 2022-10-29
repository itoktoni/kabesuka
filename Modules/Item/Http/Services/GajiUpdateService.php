<?php

namespace Modules\Item\Http\Services;

use App\Models\User;
use Modules\Item\Dao\Models\GajiDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class GajiUpdateService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if($check['status']){

            $getData = $check['data'] ?? [];
            foreach($data->detail as $item){

                $harian = $item['temp_qty'] * $item['temp_harian'];
                $detail = GajiDetail::with(['has_user'])->find($item['temp_id']);
                $user = $detail->has_user;
                $lembur = $user->gaji_lembur ?? 0;
                $total_lembur = $item['temp_lembur'] * $lembur;

                $detail->update([
                    'gaji_detail_default' => $item['temp_gaji_pokok'],
                    'gaji_detail_lembur' => $item['temp_lembur'],
                    'gaji_detail_bonus' => $item['temp_bonus'],
                    'gaji_detail_qty' => $item['temp_qty'],
                    'gaji_detail_harian' => $item['temp_harian'],
                    'gaji_detail_total_harian' => $harian,
                    'gaji_detail_total_lembur' => $total_lembur,
                    'gaji_detail_total' => $item['temp_gaji_pokok'] + $item['temp_bonus'] + $total_lembur + $harian,
                ]);
            }
        }

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
