<div class="form-group">
	{!! Form::label('name', 'Date', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4 {{ $errors->has('so_date_order') ? 'has-error' : ''}}">
		{!! Form::text('so_date_order', !empty($model->so_date_order) ? $model->so_date_order : date('Y-m-d'), ['class'
		=>
		'form-control date']) !!}
		{!! $errors->first('so_date_order', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('so_status') ? 'has-error' : ''}}">
		{{ Form::select('so_status', $status, null, ['class'=> 'form-control ']) }}
		{!! $errors->first('so_status', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">

	{!! Form::label('name', 'Customer Name', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4 {{ $errors->has('so_customer_name') ? 'has-error' : ''}}">
		{!! Form::text('so_customer_name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('so_customer_name', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Customer'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-4 col-sm-4 {{ $errors->has('so_customer_id') ? 'has-error' : ''}}">
		{{ Form::select('so_customer_id', $customer, null, ['class'=> 'form-control', 'id' => 'supplier']) }}
		{!! $errors->first('so_customer_id', '<p class="help-block">:message</p>') !!}
	</div>


</div>

<div class="group-form">
	{!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10 col-sm-10">
		{!! Form::textarea('so_notes_internal', null, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>
</div>