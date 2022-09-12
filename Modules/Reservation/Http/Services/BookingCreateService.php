<?php

namespace Modules\Reservation\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Reservation\Dao\Models\Booking;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;

class BookingCreateService
{
    public function save($repository, $data)
    {
        $check = false;
        try {

            $qty = $data->get('booking_qty');
            $booked = $data->all();
            $code = Helper::autoNumber('bookings', 'booking_code', 'B' . date('Ymd-'), env('WEBSITE_AUTONUMBER'));

            $outstanding = Booking::select('booking_meja_code')->where('booking_date', date('Y-m-d'))->get();

            if (empty($data->get('booking_meja_code'))) {

                $available = DB::table('view_meja')->whereNull('booking_date')
                    ->where('meja_capacity_start', '<=', $qty)
                    ->where('meja_capacity_end', '>=', $qty)
                    ->first();

                if($available){
                    $booked['booking_meja_code'] = $available->meja_code;
                }
                else{
                    $available = DB::table('view_meja')
                    ->where('meja_capacity_start', '<=', $qty)
                    ->where('meja_capacity_end', '>=', $qty)
                    ->whereNotIn('meja_code', $outstanding)
                    ->orderBy('total_meja')
                    ->first();

                    if($available){
                        $booked['booking_meja_code'] = $available->meja_code;
                    }
                    else{
                        $available = DB::table('view_meja')
                        ->where('meja_capacity_start', '<=', $qty)
                        ->where('meja_capacity_end', '>=', $qty)
                        ->whereDate('booking_date', date('Y-m-d'))
                        ->orderBy('total_meja')
                        ->first();

                        if($available){
                            $booked['booking_meja_code'] = $available->meja_code;
                        }
                    }
                }

            }

            $booked['booking_code'] = $code;
            $check = $repository->saveRepository($booked);

            if (isset($check['status']) && $check['status']) {

                Alert::create();
            } else {
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            dd($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
