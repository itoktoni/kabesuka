<div class="export">

    <table id="header">
        <tr>
            <td>
                REKAP DETAIL ORDER
            </td>
        </tr>

        <tr>
            <td>
                Tanggal Cetak : {{ date('d / m / Y') }}
            </td>
        </tr>
    </table>

    <table id="datatable" class="responsive table table-no-more table-bordered table-striped mb-none">
        <thead>
            <tr>
                <th class="text-left">No. Order</th>
                <th class="text-left">Nama Customer</th>
                <th class="text-left">Nama Product</th>
                <th class="text-left">Payment</th>
                <th class="text-left">Status</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Value</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Tax</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grand_total = 0;
            @endphp
            @if(!empty($preview))
            @foreach($preview as $data)
            @if($detail = $data->has_detail)
            @foreach($detail as $item)
            @php
                $discount = $tax = 0;
                if($loop->iteration == 1){
                    $discount = $data->so_discount_value;
                    $tax = $data->so_sum_tax;
                }
                $total = $item->mask_qty * $item->mask_price;
                $summary = ($total + $tax) - $discount;
                $grand_total = $grand_total + $summary;
            @endphp
            <tr>
                <td data-title="No. Order">{{ $data->so_code ?? '' }} </td>
                <td data-title="Nama Company">{{ $data->so_customer_name ?? '' }} </td>
                <td data-title="Nama Product">{{ $item->has_product->mask_name ?? '' }} </td>
                <td data-title="Nama Product">{{ $data->so_payment ?? '' }} </td>
                <td data-title="Nama Product">{{ SalesStatus::getDescription($data->so_status) ?? '' }} </td>
                <td data-title="Qty" class="text-right">{{ $item->mask_qty ?? '' }} </td>
                <td data-title="Harga" class="text-right">{{ Helper::createRupiah($item->mask_price) ?? '' }} </td>
                <td data-title="Qty" class="text-right">{{ Helper::createRupiah($total) ?? '' }} </td>
                <td data-title="Qty" class="text-right">-{{ Helper::createRupiah($discount) ?? '' }} </td>
                <td data-title="Qty" class="text-right">{{ Helper::createRupiah($tax) ?? '' }} </td>
                <td data-title="Total" class="text-right">{{ Helper::createRupiah($summary) }} </td>
            </tr>
            @endforeach
            @endif
            @endforeach
            @endif
            <tr>
                <td class="total" data-title="" colspan="10">Grand Total</td>
                <td class="total text-right" data-title="Grand Total">{{ Helper::createRupiah($grand_total) }}</td>
            </tr>
        </tbody>
    </table>
</div>


<style>
    .export {
        width: 100%;
    }

    #header {
        margin-bottom: 20px;
        font-weight: bold;
        width: 30%;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    #datatable {
        width: 100%;
        position: relative;
    }

    table tbody td {
        padding: 10px 5px;
        border: 1px solid lightgray;
    }

    table thead tr th {
        border: 1px solid gray;
        padding: 10px 5px;
        font-weight: bold;
    }

    .total {
        font-weight: bold;
        color: #fff;
        background-color: grey;
    }
</style>