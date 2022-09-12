<x-date :array="['date']" />

<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jadwal_name') ? 'has-error' : ''}}">
        {!! Form::text('jadwal_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jadwal_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Shift'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jadwal_shift_id') ? 'has-error' : ''}}">
        {{ Form::select('jadwal_shift_id', $shift, null, ['class'=> 'form-control']) }}
        {!! $errors->first('jadwal_shift_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Date'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jadwal_date') ? 'has-error' : ''}}">
        {!! Form::text('jadwal_date', null, ['class' => 'form-control date']) !!}
        {!! $errors->first('jadwal_date', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Shift'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jadwal_user_id') ? 'has-error' : ''}}">
        {{ Form::select('jadwal_user_id', $user, null, ['class'=> 'form-control']) }}
        {!! $errors->first('jadwal_user_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>