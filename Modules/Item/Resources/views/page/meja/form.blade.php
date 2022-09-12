<div class="form-group">

    {!! Form::label('name', __('Code'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('meja_code') ? 'has-error' : ''}}">
        {!! Form::text('meja_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meja_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('meja_name') ? 'has-error' : ''}}">
        {!! Form::text('meja_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meja_name', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Capacity'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('meja_capacity') ? 'has-error' : ''}}">
        {!! Form::text('meja_capacity', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meja_capacity', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('meja_description') ? 'has-error' : ''}}">
        {!! Form::text('meja_description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meja_description', '<p class="help-block">:message</p>') !!}
    </div>

</div>