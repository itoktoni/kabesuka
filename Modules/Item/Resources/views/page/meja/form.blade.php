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

	{!! Form::label('name', __('Capacity From'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('meja_capacity_start') ? 'has-error' : ''}}">
		{!! Form::text('meja_capacity_start', null, ['class' => 'form-control']) !!}
		{!! $errors->first('meja_capacity_start', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Capacity To'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('meja_capacity_end') ? 'has-error' : ''}}">
		{!! Form::text('meja_capacity_end', null, ['class' => 'form-control']) !!}
		{!! $errors->first('meja_capacity_end', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">
	{!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10 col-sm-10 {{ $errors->has('meja_description') ? 'has-error' : ''}}">
		{!! Form::textarea('meja_description', null, ['class' => 'form-control']) !!}
		{!! $errors->first('meja_description', '<p class="help-block">:message</p>') !!}
	</div>
</div>