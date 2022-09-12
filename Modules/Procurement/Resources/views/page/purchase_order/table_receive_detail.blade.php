@if(!empty($detail))

<hr>

<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-2">Receive Code</th>
            <th class="text-left col-md-1">Receive Date</th>
            <th class="text-left col-md-1">Created Time</th>
            <th class="text-left col-md-1">Branch</th>
            <th style="width: 4%;" class="text-left">Qty</th>
        </tr>
    </thead>
    <tbody class="markup">
        @foreach ($detail as $item)
        <tr>
            <td data-title="Receive Code">
                <a href="{!! route($route_index) !!}" class="btn btn-info btn-xs">
                    {{ $item->po_receive_code }}
                </a>
                <a onClick="return confirm('Are you sure you want to delete?')" href="{!! route($module.'_delete_receive_detail', ['code' => $item->po_receive_code]) !!}" class="btn btn-danger btn-xs">
                    Delete
                </a>
            </td>
            <td data-title="Receive Date">
                {{ $item->po_receive_date ?? '' }}
            </td>
            <td data-title="Receive Date">
                {{ $item->po_receive_created_at ?? '' }}
            </td>
            <td data-title="Branch">
                {{ $item->has_branch->branch_name ?? '' }}
            </td>
            <td data-title="Receive" class="col-lg-1">
                {{ $item->po_receive_receive }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="{{ $model->po_receive_type != CategoryType::Accesories ? '7' : '4' }}">Total Penerimaan Barang</td>
            <td>{{ $detail->sum('po_receive_receive') }}</td>
        </tr>
    </tbody>
</table>
@endif