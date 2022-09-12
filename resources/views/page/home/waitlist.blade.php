<div class="row">
    <div class="panel-body container">

        <table id="transaction" style="margin-top: 0px !important;font-size:20px"
            class="table table-no-more table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-left" style="width: 20%;">No.</th>
                    <th class="text-left" style="width: 40%;">Customer</th>
                    <th class="text-left" style="width: 40%;">End Time</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($detail as $item)
                <tr class="{{ $loop->even ? 'even' : 'odd' }}">
                    <td data-title="No. Order">
                        {{ substr($item->booking_code, -3) }}
                    </td>
                    <td data-title="Customer">
                        {{ $item->booking_name }}
                    </td>
                    <td data-title="Action" align="center">
                        @if(empty($item->booking_end_time))
                        Menunggu
                        @else
                        {{ substr($item->booking_end_time, -8) }}
                        @endif
                    </td>
                </tr>
                @endforeach
        </table>

    </div>
</div>