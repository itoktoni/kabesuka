<?php

namespace Modules\Reservation\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BookingRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $data = [];
        if(!empty($this->get('time'))){
            $data['booking_start_date'] = $this->get('booking_date').' '.$this->get('time');
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
