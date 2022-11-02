<div class="form-group mt-3">

	{!! Form::label('name', 'Customer', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4 {{ $errors->has('so_customer_name') ? 'has-error' : ''}}">
		{!! Form::text('so_customer_name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('so_customer_name', '<p class="help-block">:message</p>') !!}
	</div>



	{!! Form::label('name', 'Date', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4 {{ $errors->has('so_date_order') ? 'has-error' : ''}}">
		{!! Form::text('so_date_order', !empty($model->so_date_order) ? $model->so_date_order : date('Y-m-d'), ['class'
		=>
		'form-control date']) !!}
		{!! $errors->first('so_date_order', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">
	{!! Form::label('name', __('Table'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
	<div class="col-md-3 col-sm-3 {{ $errors->has('so_table') ? 'has-error' : ''}}">
		{{ Form::select('so_table', $table, null, ['class'=> 'form-control', 'id' => 'supplier']) }}
		{!! $errors->first('so_table', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Status'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
	<div class="col-md-3 col-sm-3 {{ $errors->has('so_status') ? 'has-error' : ''}}">
		{{ Form::select('so_status', $status, null, ['class'=> 'form-control ']) }}
		{!! $errors->first('so_status', '<p class="help-block">:message</p>') !!}
	</div>

	{!! Form::label('name', __('Payment'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
	<div class="col-md-3 col-sm-3 {{ $errors->has('so_payment') ? 'has-error' : ''}}">
		{{ Form::select('so_payment', $payment, null, ['class'=> 'form-control', 'id' => 'supplier']) }}
		{!! $errors->first('so_payment', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="group-form">

	{!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::textarea('so_notes_internal', null, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>

</div>

<hr>
<br>