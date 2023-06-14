<div class="navbar-fixed-bottom" id="menu_action">
    <div class="text-right action-wrapper">
        @switch($action_function)

        @case('index')
        @if(isset($actions['create']))
        <a href="{!! route($route_create) !!}" class="btn btn-success">{{ __('Create') }}</a>
        @endif

        @if(isset($actions['delete']) and auth()->user()->group_user != 'kasir')
        <button type="submit" onclick="return confirm('Are you sure to delete data ?');" id="delete-action"
            value="delete" name="action" class="btn btn-danger">{{ __('Delete') }}</button>
        @endif
        @break

        @case('create')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        <button type="reset" class="btn btn-default">{{ __('Reset') }}</button>
        @if(isset($actions['create']))
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @endif
        @break
        @case('edit')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        <a target="_blank" href="{!! route('reservation_booking_print_antrian', ['code' => $model->booking_id]) !!}" class="btn btn-info">{{ __('Print Antrian') }}</a>
        @if($model->booking_metode == PaymentType::QRIS_ONLINE)
        <a target="_blank" href="{!! route('reservation_booking_print_qris', ['code' => $model->booking_id]) !!}" class="btn btn-success">{{ __('Print QRIS') }}</a>
        @endif
        @if($model->booking_status >= BookingType::Process)
        <a target="_blank" href="{!! route('reservation_booking_print_invoice', ['code' => $model->booking_id]) !!}" class="btn btn-danger">{{ __('Print Invoice') }}</a>
        @endif
        @break

        @case('show')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        @if(isset($actions['update']))
        <a id="linkMenu" href="{!! route($route_edit, ['code' => $model->{$model->getKeyName()} ]) !!}" class="btn
            btn-primary">{{ __('Update') }}</a>
        @endif
        @break

        @endswitch
    </div>
</div>
