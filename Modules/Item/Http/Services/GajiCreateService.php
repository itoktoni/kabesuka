<?php

namespace Modules\Item\Http\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Models\Gaji as ModelsGaji;
use Modules\Item\Dao\Models\GajiDetail;
use Modules\Item\Dao\Models\Jadwal;
use Modules\Reservation\Dao\Models\Gaji;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;

class GajiCreateService
{
    public function save($repository, $data)
    {
        $check = false;
        try {

            $check = $repository->saveRepository($data->all());
            $users = $data->user;

            $total = Carbon::parse($data->gaji_start)->diffInDays($data->gaji_end);

            foreach($users as $user){

                $person = User::find($user);

                $total_transport = $total * $person->gaji_transport;
                GajiDetail::create([
                    'gaji_detail_gaji_id' => $check['data']->gaji_id,
                    'gaji_detail_date' => $data->gaji_date,
                    'gaji_detail_user_id' => $person->id,
                    'gaji_detail_default' => $person->gaji_pokok,
                    'gaji_detail_lembur' => 0,
                    'gaji_detail_bonus' => 0,
                    'gaji_detail_potongan' => 0,
                    'gaji_detail_qty' => $total,
                    'gaji_detail_harian' => $person->gaji_transport,
                    'gaji_detail_total_harian' => $total_transport,
                    'gaji_detail_total' => $person->gaji_pokok + $total_transport,
                    'gaji_detail_group_user' => $person->group_user,
                ]);
            }

            // $data_jadwal = Jadwal::whereBetween('jadwal_date', [request()->get('gaji_start'), request()->get('gaji_end')])
            // ->WhereIn('jadwal_user_id', $users)
            // ->get();

            // if($data_jadwal){
            //     $data_jadwal = $data_jadwal->mapToGroups(function($item){
            //         return [$item->jadwal_user_id => $item];
            //     });

            //     foreach($data_jadwal as $user => $jadwal){
            //         $person = User::with('has_group_user')->find($user);
            //         $group = $person->has_group_user;

            //         $gaji_default = $group->gaji_default ?? 0;
            //         $gaji_tunjangan = $group->gaji_tunjangan ?? 0;
            //         $gaji_bonus = $group->gaji_bonus ?? 0;
            //         $gaji_harian = $group->gaji_harian ?? 0;
            //         $total_harian = $gaji_harian * $jadwal->count();

            //         GajiDetail::create([
            //             'gaji_detail_gaji_id' => $check['data']->gaji_id,
            //             'gaji_detail_date' => $data->gaji_date,
            //             'gaji_detail_user_id' => $user,
            //             'gaji_detail_default' => $gaji_default,
            //             'gaji_detail_tunjangan' => $gaji_tunjangan,
            //             'gaji_detail_bonus' => $gaji_bonus,
            //             'gaji_detail_potongan' => 0,
            //             'gaji_detail_qty' => $jadwal->count(),
            //             'gaji_detail_harian' => $gaji_harian,
            //             'gaji_detail_total_harian' => $total_harian,
            //             'gaji_detail_total' => ($gaji_default + $gaji_tunjangan + $gaji_bonus + $total_harian),
            //             'gaji_detail_group_user' => $group->system_group_user_name,
            //         ]);
            //     }
            // }

            if (isset($check['status']) && $check['status']) {
                Alert::create();
            } else {
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}