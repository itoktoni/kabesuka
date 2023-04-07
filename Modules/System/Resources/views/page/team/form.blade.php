<x-date :array="['date']" />

<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Name') }}</label>
	<div class="col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Phone') }}</label>
	<div class="col-md-4 {{ $errors->has('phone') ? 'has-error' : ''}}">
		{!! Form::text('phone', null, ['class' => 'form-control']) !!}
		{!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Email') }}</label>
	<div class="col-md-4 {{ $errors->has('email') ? 'has-error' : ''}}">
		{!! Form::text('email', null, ['class' => 'form-control']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Saldo') }}</label>
	<div class="col-md-4 {{ $errors->has('saldo') ? 'has-error' : ''}}">
		{!! Form::text('saldo', null, ['class' => 'form-control']) !!}
		{!! $errors->first('saldo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

@if(auth()->user()->group_user != GroupUserType::Kasir)

<div class="form-group">

	<label class="col-md-1 control-label">{{ __('Point') }}</label>
	<div class="col-md-1 {{ $errors->has('point') ? 'has-error' : ''}}">
		{!! Form::text('point', null, ['class' => 'form-control', 'autocomplete' => false]) !!}
		{!! $errors->first('point', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-1 control-label">{{ __('KTP') }}</label>
	<div class="col-md-3 {{ $errors->has('ktp') ? 'has-error' : ''}}">
		{!! Form::text('ktp', null, ['class' => 'form-control']) !!}
		{!! $errors->first('ktp', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Birthday') }}</label>
	<div class="col-md-4 {{ $errors->has('birth') ? 'has-error' : ''}}">
		{!! Form::text('birth', null, ['class' => 'form-control date']) !!}
		{!! $errors->first('birth', '<p class="help-block">:message</p>') !!}
	</div>

</div>

<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Username') }}</label>
	<div class="col-md-4 {{ $errors->has('username') ? 'has-error' : ''}}">
		{!! Form::text('username', null, ['class' => 'form-control', 'autocomplete' => false]) !!}
		{!! $errors->first('username', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Password') }}</label>
	<div class="col-md-4 {{ $errors->has('password') ? 'has-error' : ''}}">
		{!! Form::password('password', ['class' => 'form-control','autocomplete' => false]) !!}
		{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Group') }}</label>
	<div class="col-md-4 {{ $errors->has('group_user') ? 'has-error' : ''}}">
		{{ Form::select('group_user', $group, $default ?? null, ['class'=> 'form-control']) }}
		{!! $errors->first('group_user', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Active') }}</label>
	<div class="col-md-4 {{ $errors->has('active') ? 'has-error' : ''}}">
		{{ Form::select('active', $status, null, ['class'=> 'form-control']) }}
	</div>
</div>

<hr>

<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Gaji Pokok') }}</label>
	<div class="col-md-4 {{ $errors->has('gaji_pokok') ? 'has-error' : ''}}">
		{!! Form::text('gaji_pokok', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_pokok', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('Transport') }}</label>
	<div class="col-md-4 {{ $errors->has('gaji_transport') ? 'has-error' : ''}}">
		{!! Form::text('gaji_transport', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_transport', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">{{ __('Uang Lembur') }}</label>
	<div class="col-md-4 {{ $errors->has('gaji_lembur') ? 'has-error' : ''}}">
		{!! Form::text('gaji_lembur', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_lembur', '<p class="help-block">:message</p>') !!}
	</div>

	<label class="col-md-2 control-label">{{ __('THR 1 Bulan') }}</label>
	<div class="col-md-4 {{ $errors->has('gaji_thr') ? 'has-error' : ''}}">
		{!! Form::text('gaji_thr', null, ['class' => 'form-control']) !!}
		{!! $errors->first('gaji_thr', '<p class="help-block">:message</p>') !!}
	</div>
</div>
@endif
