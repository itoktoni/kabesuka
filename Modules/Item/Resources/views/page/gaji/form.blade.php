<x-date :array="['date']" />

<div class="form-group">

	{!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('gaji_name') ? 'has-error' : ''}}">
		{!! Form::text('gaji_name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_name', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Date'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('gaji_date') ? 'has-error' : ''}}">
		{!! Form::text('gaji_date', date('Y-m-d'), ['class' => 'form-control date']) !!}
		{!! $errors->first('gaji_date', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">

	{!! Form::label('name', __('Start'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('gaji_start') ? 'has-error' : ''}}">
		{!! Form::text('gaji_start', date('Y-m-d'), ['class' => 'form-control date']) !!}
		{!! $errors->first('gaji_start', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('End'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('gaji_end') ? 'has-error' : ''}}">
		{!! Form::text('gaji_end', date('Y-m-d'), ['class' => 'form-control date']) !!}
		{!! $errors->first('gaji_end', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">

	{!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10 col-sm-10 {{ $errors->has('gaji_description') ? 'has-error' : ''}}">
		{!! Form::textarea('gaji_description', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_description', '<p class="help-block">:message</p>') !!}
	</div>

</div>

@if(isset($model))
@include($folder.'::page.'.$template.'.table')
@else
<div class="form-group">

	{!! Form::label('name', __('User'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10 col-sm-10 {{ $errors->has('user') ? 'has-error' : ''}}">
		<select multiple="multiple" name="user[]" class="form-control">
			@foreach($user as $key => $value)
			<option value="{{$key}}" selected="{{ in_array($key, $users) ? 'selected' : '' }}">{{$value}}</option>
			@endforeach
		</select>

		{!! $errors->first('user', '<p class="help-block">:message</p>') !!}
	</div>

</div>
@endif