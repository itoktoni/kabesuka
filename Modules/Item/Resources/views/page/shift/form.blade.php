<x-date :array="['date']" />

<div class="form-group">

	{!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('shift_name') ? 'has-error' : ''}}">
		{!! Form::text('shift_name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('shift_name', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('shift_description') ? 'has-error' : ''}}">
		{!! Form::text('shift_description', null, ['class' => 'form-control']) !!}
		{!! $errors->first('shift_description', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">

	{!! Form::label('name', __('Start'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('shift_start') ? 'has-error' : ''}}">
		{!! Form::text('shift_start', null, ['class' => 'form-control date']) !!}
		{!! $errors->first('shift_start', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('End'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('shift_end') ? 'has-error' : ''}}">
		{!! Form::text('shift_end', null, ['class' => 'form-control date']) !!}
		{!! $errors->first('shift_end', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">


	{!! Form::label('name', __('User'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10 col-sm-10 {{ $errors->has('user') ? 'has-error' : ''}}">
		{{ Form::select('user[]', $user, $users ?? null, ['class'=> 'form-control', 'multiple']) }}
		{!! $errors->first('user', '<p class="help-block">:message</p>') !!}
	</div>

</div>