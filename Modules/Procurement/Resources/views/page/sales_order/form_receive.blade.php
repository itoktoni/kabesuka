@extends(Views::backend())

@section('content')

<x-date :array="['date']" />

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_post_receive', 'code' =>
        $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Receive') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="">

                    @include($folder.'::page.'.$template.'.combine')
                    <input type="hidden" value="{{ $model->po_code }}" name="code">
                    <br  style="clear: both;margin-bottom:20px">

                    @include($folder.'::page.'.$template.'.table_receive')

                </div>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right action-wrapper">
                <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                @if($model->mask_status == PurchaseStatus::Create)
                <button type="submit" class="btn btn-primary">{{ __('Receive') }}</button>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection