<x-mask :array="['number', 'money']" />

<div class="form-group">

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('equipment_location_id') ? 'has-error' : ''}}">
        {{ Form::select('equipment_location_id', $location, null, ['class'=> 'form-control', 'id' => 'category']) }}
        {!! $errors->first('equipment_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('equipment_name') ? 'has-error' : ''}}">
        {!! Form::text('equipment_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('equipment_name', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Stock'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('equipment_stock') ? 'has-error' : ''}}">
        {!! Form::number('equipment_stock', null, ['class' => 'form-control']) !!}
        {!! $errors->first('equipment_stock', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('equipment_description') ? 'has-error' : ''}}">
        {!! Form::textarea('equipment_description', null, ['class' => 'form-control simple', 'rows' => '2']) !!}
        {!! $errors->first('equipment_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if($model)

<hr>
<input type="hidden" name="equipment_detail_stock_old" value="{{ $model->equipment_stock }}">
<div class="form-group">
    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('equipment_status') ? 'has-error' : ''}}">
        {{ Form::select('equipment_status', $status, null, ['class'=> 'form-control']) }}
        {!! $errors->first('equipment_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description History', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('equipment_detail_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
</div>

<hr>

<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <td class="col-md-2">Tanggal</td>
            <td class="col-md-1">Type</td>
            <td class="col-md-1 text-right">Stock Terakhir</td>
            <td class="col-md-1 text-right">Stock Baru</td>
            <td>Description</td>
        </tr>
    </thead>
    <tbody>
        @if($detail)
        @foreach($detail as $item)
        <tr>
            <td>{{ $item->equipment_detail_created_at }}</td>
            <td>{{ $item->equipment_detail_type }}</td>
            <td class="text-right">{{ $item->equipment_detail_stock_old }}</td>
            <td class="text-right">{{ $item->equipment_detail_stock_new }}</td>
            <td>{{ $item->equipment_detail_description }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@push('javascript')
<script src="{{ Helper::backend('vendor/jquery-datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#datatable').DataTable({});
});
</script>
@endpush

@push('style')
<style>
    div.dataTables_wrapper div.dataTables_filter{
        position: absolute;
        right: 120px;
        top: 10px;
    }
</style>
@endpush

@endif