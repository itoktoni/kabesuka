<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-2 col-sm-2 control-label">From Date</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="from" value="{{ request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-2 col-sm-2 control-label">To Date</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="to" value="{{ request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Payment'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('booking_metode') ? 'has-error' : ''}}">
        {{ Form::select('booking_metode', $payment, request()->get('booking_metode') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_metode', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Member'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('booking_member_id') ? 'has-error' : ''}}">
        {{ Form::select('booking_member_id', $customer, request()->get('booking_member_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_member_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('booking_status') ? 'has-error' : ''}}">
        {{ Form::select('booking_status', $booking, request()->get('booking_status') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('booking_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>


@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif