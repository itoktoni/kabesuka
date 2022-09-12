<?php

namespace Modules\Reservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PromoRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $code =  Str::snake($this->promo_name);
        $this->merge([
            'promo_code' => $code,
        ]);
    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'promo_name' => 'required|min:3',
                'promo_matrix' => 'required',
            ];
        }
        return [];
    }


    public function attributes()
    {
        return [
            'procurement_po_from_id' => 'Company',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
