<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_name') ? 'has-error' : ''}}">
        {!! Form::text('partner_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('partner_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Contact Person'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_contact') ? 'has-error' : ''}}">
        {!! Form::text('partner_contact', null, ['class' => 'form-control']) !!}
        {!! $errors->first('partner_contact', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', __('Email'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_email') ? 'has-error' : ''}}">
        {!! Form::text('partner_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('partner_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Phone'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_phone') ? 'has-error' : ''}}">
        {!! Form::text('partner_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('partner_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_description') ? 'has-error' : ''}}">
        {!! Form::textarea('partner_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('partner_description', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Address'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('partner_address') ? 'has-error' : ''}}">
        {!! Form::textarea('partner_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('partner_address', '<p class="help-block">:message</p>') !!}
    </div>

</div>