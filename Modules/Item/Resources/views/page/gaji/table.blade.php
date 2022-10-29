<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 30px;" class="text-left">ID</th>
            <th style="width: 20%;"  class="text-left">Nama Karyawan</th>
            <th class="text-right">Gaji Pokok</th>
            <th class="text-right">Lembur</th>
            <th class="text-right">Total Lembur</th>
            <th class="text-right">Bonus</th>
            <th style="width: 80px;"  class="text-right">Qty</th>
            <th class="text-right">Harian</th>
            <th class="text-right">Sum Harian</th>
            <th class="text-right">Total Gaji</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="ID Product">
                {{ $loop->iteration }}
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->gaji_detail_id }}"
                    name="detail[{{ $loop->index }}][temp_id]">
            </td>
            <td data-title="Product">
                <input type="text" readonly class="form-control input-sm"
                    value="{{ $item['temp_name'] ?? $item->has_user->name ?? '' }}" name="detail[{{ $loop->index }}][temp_nama]">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_gaji_pokok]"
                    class="form-control input-sm text-right number temp_gaji_pokok"
                    value="{{ $item['temp_gaji_pokok'] ?? $item->gaji_detail_default }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_lembur]"
                    class="form-control input-sm text-right number temp_lembur"
                    value="{{ $item['temp_lembur'] ?? $item->gaji_detail_lembur }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_total_lembur]"
                    class="form-control input-sm text-right number temp_total_lembur"
                    value="{{ $item['temp_total_lembur'] ?? $item->gaji_detail_total_lembur }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_bonus]"
                    class="form-control input-sm text-right number temp_bonus"
                    value="{{ $item['temp_bonus'] ?? $item->gaji_detail_bonus }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_qty]"
                    class="form-control input-sm text-right number temp_qty"
                    value="{{ $item['temp_qty'] ?? $item->gaji_detail_qty }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_harian]"
                    class="form-control input-sm text-right number temp_harian"
                    value="{{ $item['temp_harian'] ?? $item->gaji_detail_harian }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_sum_harian]"
                    class="form-control input-sm text-right number temp_sum_harian"
                    value="{{ $item['temp_sum_harian'] ?? $item->gaji_detail_total_harian }}">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_total]"
                    class="form-control input-sm text-right number temp_total"
                    value="{{ $item['temp_total'] ?? $item->gaji_detail_total }}">
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

</table>