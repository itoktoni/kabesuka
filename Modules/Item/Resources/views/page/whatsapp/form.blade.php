<div class="form-group">
    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wa_name') ? 'has-error' : ''}}">
        {!! Form::text('wa_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wa_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Template'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wa_template_id') ? 'has-error' : ''}}">
        {{ Form::select('wa_template_id', $templates, null, ['class'=> 'form-control', 'id' => 'category']) }}
        {!! $errors->first('wa_template_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wa_status') ? 'has-error' : ''}}">
        {{ Form::select('wa_status', $status, null, ['class'=> 'form-control', 'id' => 'category']) }}
        {!! $errors->first('wa_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Penerima'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-10 {{ $errors->has('wa_user_id') ? 'has-error' : ''}}">
        {{ Form::select('wa_user_id', $user, null, ['class'=> 'form-control', 'id' => 'category']) }}
        {!! $errors->first('wa_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
