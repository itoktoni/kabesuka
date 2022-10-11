<?php

namespace Modules\Reservation\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\Reservation\Dao\Enums\BookingType;

class BookingRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $data = [];
        if(!empty($this->get('time'))){
            $data['booking_start_date'] = $this->get('booking_date').' '.$this->get('time');
        }
        else{
            if($this->booking_status == BookingType::Process){

                $end = Carbon::parse(date('Y-m-d H:i:s'))
                ->addMinutes(env('WAKTU_MAKAN', 90))
                ->format('Y-m-d H:i:s');

                $data['booking_start_time'] = date('Y-m-d H:i:s');
                $data['booking_end_time'] = $end;
                $data['booking_status'] = BookingType::Table;
            }
        }

        $this->merge($data);
    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'booking_name' => 'required|min:3',
                'booking_qty' => 'required',
            ];
        }
        return [];
    }


    public function attributes()
    {
        return [
            'booking_name' => 'Nama',
        ];
    }

    public function messages()
    {
        return [
            'booking_name' => 'Masukan Nama !'
        ];
    }
}
