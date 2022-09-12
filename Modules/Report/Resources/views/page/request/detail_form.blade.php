<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-2 col-sm-2 control-label">Dari Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="from" value="{{ request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-2 col-sm-2 control-label">Ke Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="to" value="{{ request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('ro_product_id`') ? 'has-error' : ''}}">
        {{ Form::select('ro_product_id`', $product, request()->get('ro_product_id`') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('ro_product_id`', '<p class="help-bloc`k">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('ro_status') ? 'has-error' : ''}}">
        {{ Form::select('ro_status', $status, request()->get('ro_status') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('ro_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif