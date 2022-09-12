<?php

namespace Modules\Procurement\Http\Services;

use Modules\Procurement\Dao\Enums\RequestStatus;
use Modules\Procurement\Dao\Facades\RoDetailFacades;
use Modules\Procurement\Dao\Facades\PurchaseDetailFacades;
use Modules\Procurement\Dao\Facades\StockFacades;
use Modules\Procurement\Dao\Models\PurchaseDetail;
use Modules\Procurement\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class RequestUpdateService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        RoDetailFacades::upsert($data['detail'], [
            RoDetailFacades::mask_ro_code(),
            RoDetailFacades::mask_product_id(),
        ], [
            RoDetailFacades::mask_notes(),
            RoDetailFacades::mask_qty(),
            RoDetailFacades::mask_price(),
            RoDetailFacades::mask_total(),
        ]);

        if($data->get('ro_status') == RequestStatus::Done && count($data['detail']) > 0){
            foreach($data['detail'] as $detail){
                $datastock = StockFacades::where(StockFacades::mask_product_id(), $detail['ro_detail_product_id']);
                if($datastock->count() > 0){
                    $update = clone($datastock);

                    $stock = $datastock->first();
                    $stock->stock_qty = $stock->stock_qty - $detail['ro_detail_qty'];
                    $update->update(['stock_qty' => 0]);
                    $stock->save();
                }
            }
        }

        if (isset($check['status']) && $check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
