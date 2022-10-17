<?php

namespace Modules\Procurement\Http\Services;

use Modules\Procurement\Dao\Enums\PurchaseStatus;
use Modules\Procurement\Dao\Facades\PoDetailFacades;
use Modules\Procurement\Dao\Facades\StockFacades;
use Modules\Procurement\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class PurchaseReceiveService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        PoDetailFacades::upsert($data['detail'], [
            PoDetailFacades::mask_po_code(),
            PoDetailFacades::mask_product_id(),
        ], [
            PoDetailFacades::mask_receive(),
        ]);

        if ($data->po_status == PurchaseStatus::Receive) {

            foreach ($data['detail'] as $data_stock) {
                $stock = Stock::where(StockFacades::mask_location_id(), $data->get('po_location_id'))
                    ->where(StockFacades::mask_product_id(), $data_stock['po_detail_product_id'])->first();
                    if ($stock) {
                        $total = $stock->stock_qty + $data_stock['po_detail_qty'];
                        $stock->stock_qty = $total;
                        $stock->save();
                } else {
                    StockFacades::create([
                        'stock_location_id' => $data->get('po_location_id'),
                        'stock_product_id' => $data_stock['po_detail_product_id'],
                        'stock_qty' => $data_stock['po_detail_qty'],
                    ]);
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
