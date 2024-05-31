<x-mask :array="['number', 'money']" />
<x-date :array="['date']" />

<div class="form-group">

    {!! Form::label('name', __('Pagi atau Malam'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('type') ? 'has-error' : ''}}">
        {{ Form::select('type', ['' => '- Silahkan Pilih -', 'PGI' => 'Pagi', 'MLM' => 'Malam'], request()->get('type') ?? $model->inventory_type ?? null, ['class'=> 'form-control', 'id' => 'type']) }}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Tanggal'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('date') ? 'has-error' : ''}}">
        {!! Form::text('date', request()->get('date') ?? $model->inventory_date ?? date('Y-m-d'), ['class' => 'form-control date', 'id' => 'date']) !!}
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-2">
        <button class="btn btn-info update">Lihat</button>
        <button class="btn btn-success print">Excel</button>
    </div>

</div>


<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-3">Product Name</th>
            <th class="text-right col-md-2">Awal</th>
            <th class="text-right col-md-2">Masuk</th>
            <th class="text-right col-md-2">Akhir</th>
            <th class="text-right col-md-2">Keluar</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @php
        $type = request()->get('type');
        @endphp
        @foreach (old('detail') ?? $detail as $item)
        @php
        if($type == 'PGI')
        {
            $masuk = $item->masuk_pagi ?? 0;
            $akhir = $item->akhir_pagi ?? 0;
            $keluar = $item->keluar_pagi ?? 0;

            if($database->count() > 0)
            {
                $dapet = $database[$item->product_id] ?? false;
                $awal = $dapet->awal_pagi ?? 0;
                $masuk = $dapet->masuk_pagi ?? 0;
                $akhir = $dapet->akhir_pagi ?? 0;
                $keluar = $dapet->keluar_pagi ?? 0;
            }
            else
            {
                $dapet = $last[$item->product_id] ?? 0;
                $awal = $dapet->akhir_malam ?? 0;
                $masuk = 0;
                $akhir = 0;
                $keluar = 0;
            }
        }
        else
        {
            $masuk = $item->masuk_malam ?? 0;
            $akhir = $item->akhir_malam ?? 0;
            $keluar = $item->keluar_malam ?? 0;

            if(!empty($database) && $database->count() > 0)
            {
                $dapet = $database[$item->product_id] ?? false;
                $awal = $dapet->awal_malam ?? 0;

                if($type == 'MLM'){
                    $dapet = $last[$item->product_id] ?? 0;
                    $awal = $dapet->akhir_pagi ?? 0;
                }

                $masuk = $dapet->masuk_malam ?? 0;
                $akhir = $dapet->akhir_malam ?? 0;
                $keluar = $dapet->keluar_malam ?? 0;
            }
            else
            {
                $dapet = $last[$item->product_id] ?? false;
                $awal = $dapet->akhir_pagi ?? 0;
                $masuk = 0;
                $akhir = 0;
                $keluar = 0;
            }
        }
        @endphp
        <tr>
            <input type="hidden" value="{{ $item->product_id ?? '' }}" name="detail[{{ $loop->index }}][temp_id]">
            <td data-title="Product">
                <input type="text" readonly class="form-control input-sm" value="{{ $item->product_name ?? '' }}">
            </td>
            <td data-title="Awal" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}2" tabindex="{{ $loop->iteration }}2" name="detail[{{ $loop->index }}][temp_awal]" class="form-control input-sm text-right awal" value="{{ $awal ?? 0 }}">

            </td>
            <td data-title="Masuk" class="text-right col-lg-1">
                <input type="text" name="detail[{{ $loop->index }}][temp_masuk]" tabindex="{{ $loop->iteration }}3" class="form-control input-sm text-right masuk" value="{{ floatval($masuk) }}">
            </td>
            <td data-title="Akhir" class="text-right col-lg-1">
                <input type="text" name="detail[{{ $loop->index }}][temp_akhir]" tabindex="{{ $loop->iteration }}4" class="form-control input-sm text-right akhir" value="{{ floatval($akhir) ?? 0 }}">
            </td>
            <td data-title="Keluar" class="text-right col-lg-1">
                <input type="text" name="detail[{{ $loop->index }}][temp_keluar]" readonly class="form-control input-sm text-right keluar" value="{{ floatval($keluar) ?? 0 }}">
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

</table>

@push('javascript')
<script>
    $(document).ready(function() {

        function total(data){
            var awal = $(data).closest('tr').find('.awal');
            var masuk = $(data).closest('tr').find('.masuk');
            var akhir = $(data).closest('tr').find('.akhir');
            var keluar = $(data).closest('tr').find('.keluar');

            var total = (numeral(awal.val()).value() + numeral(masuk.val()).value()) - numeral(akhir.val()).value();
            keluar.val((Math.round(total * 100) / 100).toFixed(2));
        }

        function redirect(){
            var type = $("#type option:selected").val();
            var date = $("#date").val();
            var newUrl = window.location.origin + window.location.pathname +"?date=" + date + "&type=" + type;
            window.location.href = newUrl;
        }

        $('.update').click(function(e) {
            e.preventDefault();
            redirect();
        });

        $('#type').change(function(e) {
            e.preventDefault();
            redirect();
        });

        $('#date').change(function(e) {
            e.preventDefault();
            redirect();
        });

        $('.print').click(function(e) {
            e.preventDefault();
            var type = $("#type option:selected").val();
            var date = $("#date").val();
            var newUrl = window.location.origin + window.location.pathname +"?date=" + date + "&type=" + type+"&action=excel";
            window.location.href = newUrl;
        });

        $("#transaction").on('input', '.awal', function() {
            total(this);
        });

        $("#transaction").on('input', '.masuk', function() {
            total(this);
        });

        $("#transaction").on('input', '.akhir', function() {
            total(this);
        });
    });
</script>
@endpush