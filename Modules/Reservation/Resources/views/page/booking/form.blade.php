<x-date :array="['date']" />
<x-mask :array="['number', 'money']" />

<table class="table table-no-more table-bordered table-striped">
    <tr>
        @foreach($meja as $key => $value)
        @if(!empty($key))
        <td><h5 class="text-center">{{ $value ?? '' }}</h5></td>
        @endif
        @endforeach
    </tr>

    <tr>
        @foreach($meja as $key => $value)
        @if(!empty($key))
        <td>
            @foreach(Adapter::getBookingMejaDate($key, date('Y-m-d')) as $booked)
            <a href="{{ route('reservation_booking_edit', ['code' => $booked->booking_id]) }}" class="btn btn-block {{ $booked->booking_start_time ? 'btn-danger' : 'btn-default' }}">
                <b>{{ substr($booked->booking_code, -3) ?? '' }}</b> <br> {{ $booked->booking_name }}  {!! $booked->booking_start_date ? '<br> : '.substr($booked->booking_start_date, 11, 5) : '' !!}
            </a>
            @endforeach
        </td>
        @endif
        @endforeach
    </tr>
</table>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Member'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('booking_member_id') ? 'has-error' : ''}}">
        {{ Form::select('booking_member_id', $user, null, ['class'=> 'form-control member', 'id' => 'province']) }}
        {!! $errors->first('booking_member_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('booking_name') ? 'has-error' : ''}}">
        {!! Form::text('booking_name', null, ['class' => 'form-control name']) !!}
        {!! $errors->first('booking_name', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Email'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('booking_email') ? 'has-error' : ''}}">
        {!! Form::text('booking_email', null, ['class' => 'form-control email']) !!}
        {!! $errors->first('booking_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Phone'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('booking_phone') ? 'has-error' : ''}}">
        {!! Form::text('booking_phone', null, ['class' => 'form-control phone']) !!}
        {!! $errors->first('booking_phone', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Birthday'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('birthday') ? 'has-error' : ''}}">
        {!! Form::text('birthday', old('birthday') ?? null, ['class' => 'form-control date']) !!}
        {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Tanggal'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_date') ? 'has-error' : ''}}">
        {!! Form::text('booking_date', null ?? date('Y-m-d'), ['class' => 'form-control date']) !!}
        {!! $errors->first('booking_date', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Jam'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('time') ? 'has-error' : ''}}">
        {{ Form::select('time', $jam, request()->get('time') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Dewasa'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_dewasa_qty') ? 'has-error' : ''}}">
        {!! Form::text('booking_dewasa_qty', null, ['class' => 'form-control dewasa']) !!}
        {!! $errors->first('booking_dewasa_qty', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-1 col-sm-1 control-label" for="">{{ Helper::createRupiah(env('PRICE_DEWASA')) }}</label>

    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_dewasa_price') ? 'has-error' : ''}}">
        {!! Form::text('booking_dewasa_price', null, ['class' => 'form-control price-dewasa', 'readonly']) !!}
        {!! $errors->first('booking_dewasa_price', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Qty'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_qty') ? 'has-error' : ''}}">
        {!! Form::text('booking_qty', null, ['class' => 'form-control qty']) !!}
        {!! $errors->first('booking_qty', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Meja'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_meja_code') ? 'has-error' : ''}}">
        {{ Form::select('booking_meja_code', $meja, request()->get('booking_meja_code') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_meja_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Lansia'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_lansia_qty') ? 'has-error' : ''}}">
        {!! Form::text('booking_lansia_qty', null, ['class' => 'form-control lansia']) !!}
        {!! $errors->first('booking_lansia_qty', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-1 col-sm-1 control-label" for="">{{ Helper::createRupiah(env('PRICE_LANSIA')) }}</label>

    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_lansia_price') ? 'has-error' : ''}}">
        {!! Form::text('booking_lansia_price', null, ['class' => 'form-control price-lansia', 'readonly']) !!}
        {!! $errors->first('booking_lansia_price', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Urutan'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_sort') ? 'has-error' : ''}}">
        {!! Form::text('booking_sort', null, ['class' => 'form-control']) !!}
        {!! $errors->first('booking_sort', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('name', __('Status'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_status') ? 'has-error' : ''}}">
        {{ Form::select('booking_status', $status, $booking_status ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Anak-Anak'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_anak_qty') ? 'has-error' : ''}}">
        {!! Form::text('booking_anak_qty', null, ['class' => 'form-control anak']) !!}
        {!! $errors->first('booking_anak_qty', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-1 col-sm-1 control-label" for="">{{ Helper::createRupiah(env('PRICE_ANAK')) }}</label>
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_anak_price') ? 'has-error' : ''}}">
        {!! Form::text('booking_anak_price', null, ['class' => 'form-control price-anak', 'readonly']) !!}
        {!! $errors->first('booking_anak_price', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Total Value'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_value') ? 'has-error' : ''}}">
        {!! Form::text('booking_value', null, ['class' => 'form-control value']) !!}
        {!! $errors->first('booking_value', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('DP'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_dp') ? 'has-error' : ''}}">
        {!! Form::text('booking_dp', null, ['class' => 'form-control dp']) !!}
        {!! $errors->first('booking_dp', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Discount'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_discount_code') ? 'has-error' : ''}}">
        {{ Form::select('booking_discount_code', $promo, null, ['class'=> 'form-control promo']) }}
        {!! $errors->first('booking_discount_code', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-1 col-sm-1 control-label" for="">Potongan</label>
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_discount_value') ? 'has-error' : ''}}">
        {!! Form::text('booking_discount_value', null, ['class' => 'form-control discount', 'readonly']) !!}
        <input type="hidden" class="discount_description" name="booking_discount_description">
        {!! $errors->first('booking_discount_value', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group"  style="margin-bottom: 100px;">

    {!! Form::label('name', __('Total + PPN'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_summary') ? 'has-error' : ''}}">
        {!! Form::text('booking_summary', null, ['class' => 'form-control total']) !!}
        {!! $errors->first('booking_summary', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Pembayaran'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_metode') ? 'has-error' : ''}}">
        {{ Form::select('booking_metode', ['CASH' => 'CASH', 'DEBIT' => 'DEBIT', 'QRIS' => 'QRIS'], null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_metode', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-2 col-sm-2 {{ $errors->has('booking_status') ? 'has-error' : ''}}">
        {{ Form::select('booking_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>

@push('javascript')
<script>

function calculate(discount = 0) {
    var anak = $(".anak").val() != "" ? $(".anak").val() : 0;
    var lansia = $(".lansia").val() != "" ? $(".lansia").val() : 0;
    var dewasa = $(".dewasa").val() != "" ? $(".dewasa").val() : 0;
    var dp = $(".dp").val() != "" ? $(".dp").val() : 0;
    var promo_id = $(".promo option:selected").val();

    var total_anak = parseInt(anak) * "{{ env('PRICE_ANAK') }}";
    var total_dewasa = parseInt(dewasa) * "{{ env('PRICE_DEWASA') }}";
    var total_lansia = parseInt(lansia) * "{{ env('PRICE_LANSIA') }}";

    var qty = parseInt(anak) + parseInt(lansia) + parseInt(dewasa);

    var value = (total_anak + total_dewasa + total_lansia) - dp;
    var total = value;

    if(value == '' || value == '0'){
        alert('Masukan Qty Orang!');
        return;
    }

    $('.value').val(value);
    $(".qty").val(qty);

    if(promo_id){
        $.ajax({
            url: '{{ route("promo") }}',
            method: 'POST',
            data: {
                id: promo_id,
                value: value,
                dp: dp,
                "_token": "{{ csrf_token() }}"
            },
            success: function(result) {
                if (result) {
                    total = result.total;
                    $('.discount').val('');
                    $('.discount').val(result.discount);
                    $('.discount').val(result.discount);
                    $('.discount_description').val(result.name);
                    $('.total').val(result.total);

                } else {
                    $('.discount').val(0);
                }
            }
        });
    }

    var ppn = parseInt(total) * ("{{ env('PPN') }}" / 100);
    $(".total").val(total + ppn);
}

$('.anak').change(function() {
    var anak = $(".anak").val() != "" ? $(".anak").val() : 0;
    var total_anak = parseInt(anak) * "{{ env('PRICE_ANAK') }}";
    $('.price-anak').val(total_anak);

    calculate();
});

$('.lansia').change(function() {

    var lansia = $(".lansia").val() != "" ? $(".lansia").val() : 0;
    var total_lansia = parseInt(lansia) * "{{ env('PRICE_LANSIA') }}";
    $('.price-lansia').val(total_lansia);

    calculate();
});

$('.dewasa').change(function() {

    var dewasa = $(".dewasa").val() != "" ? $(".dewasa").val() : 0;
    var total_dewasa = parseInt(dewasa) * "{{ env('PRICE_DEWASA') }}";
    $('.price-dewasa').val(total_dewasa);

    calculate();
});

$('.dp').change(function() {
    calculate();
});

// $('.bayar').keyup(function(){
//     var total = $('.total').val();
//     var kembalian = $('.bayar').val() - total;
//     $('.kembalian').val(kembalian);
// });

$('.member').change(function(e) {
    var id = $(".member option:selected").val();
    $.ajax({
        url: '{{ route("user") }}',
        method: 'POST',
        data: {
            id: id,
            "_token": "{{ csrf_token() }}"
        },
        success: function(result) {
            if (result) {
                $('.name').val('');
                $('.phone').val('');
                $('.email').val('');

                $('.name').val(result.name);
                $('.phone').val(result.phone);
                $('.email').val(result.email);
            } else {
                $('.name').val('');
                $('.phone').val('');
                $('.email').val('');
            }
        }
    });
});

$('.promo').change(function(e) {
    calculate();
});
</script>
@endpush