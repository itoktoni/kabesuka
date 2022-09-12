<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Reservation\Dao\Enums\BookingType;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $data = [];
        if (!empty($this->get('time'))) {
            $data['booking_start_date'] = $this->get('date') . ' ' . $this->get('time');
        }

        $data['booking_date'] = $this->get('date');
        $data['booking_name'] = $this->get('name');
        $data['booking_email'] = $this->get('email');
        $data['booking_phone'] = $this->get('phone');
        $data['booking_qty'] = $this->get('qty');
        $data['booking_status'] = BookingType::Create;

        $data['booking_dp'] = $this->get('qty') * env('PRICE_DEWASA') * (env('DP') / 100);

        $this->merge($data);

    }

    public function rules()
    {
        if (request()->method('POST')) {
            return [
                'name' => 'required|min:3',
                'qty' => 'required',
                'date' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ];
        }

        return [];
    }
}
