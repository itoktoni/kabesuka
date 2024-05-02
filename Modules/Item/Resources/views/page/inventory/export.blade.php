<div class="export">

    <table id="header">
        <tr>
            <td>
                INVENTORY {{ request()->get('date') }}
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
                <th class="text-left" style="width:15%">Kode</th>
                <th class="text-left" style="width:15%">Tanggal</th>
                <th class="text-left" style="width:15%">Product</th>
                <th class="text-right" style="width:7%">Awal Pagi</th>
                <th class="text-right" style="width:7%">Masuk Pagi</th>
                <th class="text-right" style="width:7%">Akhir Pagi</th>
                <th class="text-right" style="width:5%">Keluar Pagi</th>
                <th class="text-right" style="width:7%">Awal Malam</th>
                <th class="text-right" style="width:7%">Masuk Malam</th>
                <th class="text-right" style="width:7%">Akhir Malam</th>
                <th class="text-right" style="width:5%">Keluar Malam</th>
        </thead>
        <tbody>
            @php
            $grand_total = 0;
            @endphp
            @foreach($preview as $data)
            <tr>
                <td data-title="No">{{ $loop->iteration }} </td>
                <td data-title="No. Order">{{ $data->inventory_code ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->inventory_date ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->product_name ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->awal_pagi ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->masuk_pagi ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->akhir_pagi ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->keluar_pagi ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->awal_malam ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->masuk_malam ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->akhir_malam ?? '' }} </td>
                <td data-title="Nama Customer">{{ $data->keluar_malam ?? '' }} </td>
            </tr>
            @endforeach

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