@component('components.summernote', ['array' => ['basic']])
@endcomponent

@component('components.date', ['array' => ['date']])
@endcomponent

<div class="form-group">

    {!! Form::label('name', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'code') ? 'has-error' : ''}}">
        {!! Form::text($form.'code', null, ['class' => 'form-control']) !!}
        {!! $errors->first($form.'code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'name') ? 'has-error' : ''}}">
        {!! Form::text($form.'name', null, ['class' => 'form-control']) !!}
        {!! $errors->first($form.'name', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>
<div class="form-group">

    {!! Form::label('name', 'Minimum Payment', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'minimal') ? 'has-error' : ''}}">
        {!! Form::text($form.'minimal', null, ['class' => 'form-control']) !!}
        {!! $errors->first($form.'minimal', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Maximum Per Days', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'maximal') ? 'has-error' : ''}}">
        {!! Form::text($form.'maximal', null, ['class' => 'form-control']) !!}
        {!! $errors->first($form.'maximal', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', 'Start Date', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'start_date') ? 'has-error' : ''}}">
        {!! Form::text($form.'start_date', null, ['class' => 'form-control date']) !!}
        {!! $errors->first($form.'start_date', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'End Date', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'end_date') ? 'has-error' : ''}}">
        {!! Form::text($form.'end_date', null, ['class' => 'form-control date']) !!}
        {!! $errors->first($form.'end_date', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', 'Image', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'file') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $form.'image' }}" name="$form.'image'">
        <input type="file" name="{{ $form.'file' }}"
            class="{{ $errors->has($form.'file') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first($form.'file', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group">
    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea($form.'description', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('name', 'Matrix [ *use @value ] ', ['class' => 'col-md-2 control-label']) !!}
   <div class="col-md-10 {{ $errors->has($form.'matrix') ? 'has-error' : ''}}">
        {!! Form::text($form.'matrix', null, ['class' => 'form-control']) !!}
        {!! $errors->first($form.'matrix', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<hr>

<hr>
<div class="form-group">

    <div class="col-md-2">
        @isset($model->{$form.'image'})
        <img class="img-thumbnail" src="{{ Helper::files('promo/'.$model->{$form.'image'}) }}" alt="">
        @endisset
    </div>

    <div class="col-md-10">
        {!! Form::textarea($form.'page', null, ['class' => 'form-control basic', 'rows' => '5']) !!}
    </div>
</div>