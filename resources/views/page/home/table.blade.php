<div class="row">
    <div class="panel-body">

        <table id="transaction" style="margin-top: 0px !important"
            class="table table-no-more table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-left" style="width:30px;">No. Order</th>
                    <th class="text-left col-md-2">Customer Name</th>
                    <th class="text-left col-md-2">Meja</th>
                    <th class="text-center col-md-1" style="width:10px;">Qty</th>
                    <th class="text-left col-md-2">End Time</th>
                    <th class="text-center" style="width:20px">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($detail as $item)
                @php
                $now = \Carbon\Carbon::now();
                $end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->booking_end_time, 'Asia/Jakarta');

                $diff = $now->diffInMinutes($end, false);
                $human = $now->diff($end);
                @endphp
                @if($diff > -env('WAITING_LIST'))
                <tr class="{{ $loop->even ? 'even' : 'odd' }}">
                    <td data-title="No. Order">
                        {{ $item->booking_code }}
                    </td>
                    <td data-title="Customer">
                        {{ $item->booking_name }}
                    </td>
                    <td data-title="Product">
                        {{ $item->booking_meja_code }}
                    </td>
                    <td data-title="Qty" align="center">
                        {{ $item->booking_qty }}
                    </td>
                    <td data-title="Notes">
                        {{ $item->booking_end_time }}
                    </td>
                    <td data-title="Action" align="center">
                        <a href="#"
                            class="btn btn-{{ $diff > 0 ? 'success' : 'danger' }} btn-block">
                            {{ $human->format('%H Jam %i Menit') }}
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
        </table>

    </div>
</div>