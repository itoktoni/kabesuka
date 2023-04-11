<div class="export">

    <table id="header">
        <tr>
            <td>
                REKAP TOTAL BOOKING
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
                <th class="text-left" style="width:2%">No.</th>
                <th class="text-left" style="width:15%">No. Booking</th>
                <th class="text-left" style="width:15%">Nama</th>
                <th class="text-right" style="width:7%">Dewasa</th>
                <th class="text-right" style="width:7%">Anak</th>
                <th class="text-right" style="width:7%">Lansia</th>
                <th class="text-right" style="width:5%">Qty</th>
                <th class="text-right" style="width:10%">Value</th>
                <th class="text-right" style="width:10%">DP</th>
                <th class="text-right" style="width:10%">Discount</th>
                <th class="text-right" style="width:10%">Total</th>
                <th class="text-right" style="width:15%">Tagihan</th>
                <th class="text-right" style="width:15%">Metode</th>
                <th class="text-right" style="width:10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $grand_total = 0;
            @endphp
            @foreach($preview as $data)
            @php
            $total = (($data->booking_value + $data->booking_dp) - $data->booking_discount_value);
            $grand_total = $grand_total + $total;
            @endphp
            <tr>
                <td data-title="No">{{ $loop->iteration }} </td>
                <td data-title="No. Order">{{ $data->booking_code ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->booking_name ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->booking_dewasa_qty ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->booking_anak_qty ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->booking_lansia_qty ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->booking_qty ?? '' }} </td>
                <td class="text-right" data-title="Total">{{ Helper::createRupiah($data->booking_value) }} </td>
                <td class="text-right" data-title="Total">{{ Helper::createRupiah($data->booking_dp) }} </td>
                <td class="text-right" data-title="Total">{{ Helper::createRupiah($data->booking_discount_value) }}</td>
                <td class="text-right" data-title="Pembayaran">{{ Helper::createRupiah($total) }} </td>
                <td class="text-right" data-title="Pembayaran">{{ Helper::createRupiah($data->booking_summary) }} </td>
                <td class="text-right" data-title="Outstanding">{{ $data->booking_metode }} </td>
                <td class="text-right" data-title="Outstanding">{{ BookingType::getDescription($data->booking_status) }} </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <hr>

    <table>
        <tr>
            <td class="total" data-title="" colspan="13">Grand Total</td>
            <td class="total text-right" data-title="Grand Total">
                {{ Helper::createRupiah($grand_total) }}
            </td>
        </tr>
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

table tbody tr td {
    padding: 10px 5px !important;
    border: 1px bookinglid lightgray;
}

table thead tr th {
    border: 1px bookinglid gray;
    padding: 10px 5px !important;
    font-weight: bold;
}

.total {
    font-weight: bold;
    color: #fff;
    background-color: grey;
}
</style>