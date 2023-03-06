<div class="action text-center">
    @if (isset($actions['update']))
    <a id="linkMenu" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-primary">{{ 'Edit' }}</a>
	@endif
    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-danger">{{ 'Send' }}</a>
</div>