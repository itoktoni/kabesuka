<div class="form-group">
    {!! Form::label('name', __('Name'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('template_name') ? 'has-error' : ''}}">
        {!! Form::text('template_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('template_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Url'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('template_url') ? 'has-error' : ''}}">
        {!! Form::text('template_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('template_url', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Image', ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('template_image') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $form.'image' }}" name="$form.'image'">
        <input type="file" name="{{ 'file' }}"
            class="{{ $errors->has('template_image') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('template_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', __('Description'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-8 col-sm-8">
        {!! Form::textarea('template_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
    @if(isset($model) and !empty($model->template_image))
    <div class="col-md-3 col-sm-3">
        <img class="img-thumbnail" src="{{ Helper::files('template/'.$model->template_image) }}" alt="">
    </div>
    @endif
</div>