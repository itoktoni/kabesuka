<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('promo_name') ? 'has-error' : ''}}">
        {!! Form::text('promo_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('promo_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('promo_status') ? 'has-error' : ''}}">
        {{ Form::select('promo_status', [1 => 'Active', 0 => 'Not Active'], request()->get('promo_status') ?? 2, ['class'=> 'form-control ']) }}
        {!! $errors->first('promo_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', __('Matix'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('promo_matrix') ? 'has-error' : ''}}">
        {!! Form::textarea('promo_matrix', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('promo_matrix', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('promo_description') ? 'has-error' : ''}}">
        {!! Form::textarea('promo_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('promo_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>