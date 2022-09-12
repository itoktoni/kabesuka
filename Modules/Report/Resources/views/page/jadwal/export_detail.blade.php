<div class="export">

    <table id="header">
        <tr>
            <td>
                REKAP JADWAL
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
                <th class="text-left" style="width:1%">No.</th>
                <th class="text-left" style="width:10%">Nama Jadwal</th>
                <th class="text-left" style="width:5%">Tanggal</th>
                <th class="text-right" style="width:20%">Karyawan</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($preview))
            @foreach($preview as $item)
            <tr>
                <td data-title="No">{{ $loop->iteration }} </td>
                <td data-title="No. Order">{{ $item->shift_name ?? '' }} </td>
                <td data-title="Nama Product">{{ $item->shift_start->format('Y-m-d').' - '.$item->shift_end->format('Y-m-d') ?? '' }} </td>
                <td data-title="Qty" class="text-right">
                    @if($item->has_jadwal)
                    @foreach($item->has_jadwal as $jadwal)
                    {{ $jadwal->has_user->name ?? '' }},
                    @endforeach
                    @endif
                </td>
            </tr>
            @endforeach
            @endif

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