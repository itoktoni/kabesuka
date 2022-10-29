<div class="form-group">
    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('category_name') ? 'has-error' : ''}}">
        {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Image', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('category_image') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $form.'image' }}" name="$form.'image'">
        <input type="file" name="{{ 'file' }}"
            class="{{ $errors->has('category_image') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('category_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', __('Show in Web'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('category_frontend') ? 'has-error' : ''}}">
        {{ Form::select('category_frontend', ['0' => 'No', '1' => 'Yes'], null, ['class'=> 'form-control', 'id' => 'category']) }}
        {!! $errors->first('category_frontend', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('category_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
</div>