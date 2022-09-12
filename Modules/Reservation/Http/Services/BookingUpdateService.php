<?php

namespace Modules\Reservation\Http\Services;

use App\Models\User;
use Ixudra\Curl\Facades\Curl;
use Modules\Reservation\Dao\Enums\BookingType;
use Modules\Reservation\Dao\Models\Booking;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class BookingUpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        $data = $check['data'] ?? false;
        if ($check['status']) {

            if($data && $data['booking_metode'] == 'QRIS' && empty($data['booking_qris_content'])){
                try {
                    $get_qris = Curl::to(env('QRIS_API'))->withData([
                        'do' => 'Invoice',
                        'apikey' => env('QRIS_KEY'),
                        'mID' => env('QRIS_MID'),
                        'cliTrxNumber' => $code,
                        'cliTrxAmount' => env('APP_ENV') ? 1 : $data['booking_summary'],
                    ])->get();

                    $content = json_decode($get_qris);

                    if ($content->status == 'success') {
                        $qris_data = $content->data;

                        $update = Booking::where('booking_id', $code)->first();
                        if ($update) {

                            $update->update([
                                'booking_qris_content' => $qris_data->qris_content,
                                'booking_qris_request_date' => $qris_data->qris_request_date,
                                'booking_qris_date' => $qris_data->qris_request_date,
                                'booking_qris_invoiceid' => $qris_data->qris_invoiceid,
                                'booking_qris_nmid' => $qris_data->qris_nmid,
                            ]);
                        }
                    }

                } catch (\Throwable $th) {
                    //throw $th;
                    Alert::error($th->getMessage());
                }
            }

            if (request()->wantsJson()) {
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}