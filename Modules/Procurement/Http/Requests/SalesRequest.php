<?php

namespace Modules\Procurement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Procurement\Dao\Enums\PurchasePayment;
use Modules\Procurement\Dao\Enums\PurchaseStatus;
use Modules\Procurement\Dao\Enums\SupplierPph;
use Modules\Procurement\Dao\Enums\SupplierPpn;
use Modules\Procurement\Dao\Enums\SupplierType;
use Modules\Procurement\Dao\Facades\SoDetailFacades;
use Modules\Procurement\Dao\Facades\SoFacades;
use Modules\Procurement\Dao\Facades\SupplierFacades;
use Modules\Procurement\Dao\Models\Po;
use Modules\Procurement\Dao\Models\So;
use Modules\System\Plugins\Helper;

class SalesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private static $model;

    public function __construct(So $models)
    {
        self::$model = $models;
    }

    public function prepareForValidation()
    {
        $autonumber = Helper::autoNumber(self::$model->getTable(), self::$model->getKeyName(), 'SO' . date('Ym'), env('WEBSITE_AUTONUMBER'));
        if (!empty($this->code)) {
            $autonumber = $this->code;
        }

        $map = collect($this->detail)->map(function ($item) use ($autonumber) {
            $data_product = ProductFacades::singleRepository($item['temp_id']);
            $total = Helper::filterInput($item['temp_qty']) * Helper::filterInput($item['temp_price']) ?? 0;
            $data[SoDetailFacades::mask_so_code()] = $autonumber;
            $data[SoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[SoDetailFacades::mask_notes()] = $item['temp_desc'];
            $data[SoDetailFacades::mask_product_price()] = $data_product->mask_buy ?? '';
            $data[SoDetailFacades::mask_qty()] = Helper::filterInput($item['temp_qty']);
            $data[SoDetailFacades::mask_price()] = Helper::filterInput($item['temp_price']) ?? 0;
            $data[SoDetailFacades::mask_total()] = $total;
            return $data;
        });

        $total_value = Helper::filterInput($map->sum(SoDetailFacades::mask_total())) ?? 0;
        $total_discount = Helper::filterInput($this->{SoFacades::mask_discount()}) ?? 0;
        $discount_value = Helper::filterInput($this->{SoFacades::mask_discount_value()}) ?? 0;
        // $supplier = SupplierFacades::find($this->so_supplier_id);

        $percent_pph = env('TAX_PPH', 0.5) / 100;
        $percent_ppn = env('TAX_PPN', 10) / 100;
        $percent_dpp = $total_value;

        // $total_tax = $total_dpp = $total_pph = $total_ppn = 0;
        // if ($supplier && $supplier->mask_ppn == SupplierPpn::PPN) {

        //     $total_dpp = round($total_value / ((env('TAX_PPN', 10) + 100) / 100));
        //     $total_ppn = round($total_dpp * $percent_ppn);
        //     $total_tax = $total_ppn;

        //     if ($supplier->mask_pph == SupplierPph::PPH) {
        //         $dpp_ppn = ((env('TAX_PPN', 10) + 100) / 100);
        //         $total_dpp = round($total_value / ($dpp_ppn + $percent_pph));
        //         $total_ppn = round($total_dpp * $percent_ppn);
        //         $total_pph = round($total_dpp * $percent_pph);
        //         $total_tax = $total_pph + $total_pph;
        //     }
        // }

        $total_data = ($total_value - $discount_value);
        $total_tax = ($total_data * env('PPN')) / 100;
        $total_summary = $total_data + $total_tax;
        $this->merge([
            'so_customer_name' => !empty($this->so_customer_name) ? $this->so_customer_name : 'Walk Customer',
            SoFacades::getKeyName() => $autonumber,
            SoFacades::mask_value() => $total_value,
            SoFacades::mask_tax() => $total_tax,
            // SoFacades::mask_pph() => $total_pph,
            // SoFacades::mask_ppn() => $total_ppn,
            // SoFacades::mask_dpp() => $total_dpp,
            SoFacades::mask_discount() => $total_discount,
            SoFacades::mask_discount_value() => $discount_value,
            SoFacades::mask_total() => $total_summary,
            'detail' => array_values($map->toArray()),
        ]);

    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'so_customer_name' => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            'so_customer_name' => 'Customer',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
