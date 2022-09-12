<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_name') ? 'has-error' : ''}}">
        {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Contact Person'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_contact') ? 'has-error' : ''}}">
        {!! Form::text('customer_contact', null, ['class' => 'form-control']) !!}
        {!! $errors->first('customer_contact', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', __('Email'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_email') ? 'has-error' : ''}}">
        {!! Form::text('customer_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('customer_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Phone'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_phone') ? 'has-error' : ''}}">
        {!! Form::text('customer_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('customer_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', __('Address'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_address') ? 'has-error' : ''}}">
        {!! Form::textarea('customer_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('customer_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('customer_description') ? 'has-error' : ''}}">
        {!! Form::textarea('customer_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('customer_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>