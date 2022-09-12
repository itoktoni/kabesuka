<div class="form-group">
    {!! Form::label('system_group_user_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_code') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_code', null, ['class' => 'form-control', isset($model) ? 'readonly' : '' ])
        !!}
        {!! $errors->first('system_group_user_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_user_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_name') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_user_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Template Dashboard', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_dashboard') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_dashboard', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_user_dashboard', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_visible') ? 'has-error' : ''}}">
        {{ Form::select('system_group_user_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_group_user_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('system_group_user_description', null, ['class' => 'form-control', 'rows' =>
        '3']) !!}
    </div>
</div>

<hr>

<div class="form-group">
    {!! Form::label('system_group_user_code', 'Gaji Default', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('gaji_default') ? 'has-error' : ''}}">
        {!! Form::text('gaji_default', null, ['class' => 'form-control'])
        !!}
        {!! $errors->first('gaji_default', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_user_name', 'Tunjangan', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('gaji_tunjangan') ? 'has-error' : ''}}">
        {!! Form::text('gaji_tunjangan', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gaji_tunjangan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('system_group_user_code', 'Bonus', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('gaji_bonus') ? 'has-error' : ''}}">
        {!! Form::text('gaji_bonus', null, ['class' => 'form-control'])
        !!}
        {!! $errors->first('gaji_bonus', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_user_name', 'Gaji Harian', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('gaji_harian') ? 'has-error' : ''}}">
        {!! Form::text('gaji_harian', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gaji_harian', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>