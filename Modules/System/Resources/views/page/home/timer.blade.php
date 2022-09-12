@extends(Views::backend())
@push('css')
<style>
#transaction {
    font-size: 20px;
    border: 1.4px solid grey;
}

#transaction td {
    border: 0.5px solid grey;
    font-size: 18px;
}

.even {
    background-color: rgb(247, 245, 234);
}
</style>
@endpush

@push('javascript')
<script>
(function worker() {
    var link = "{{ route('timer') }}";
    $.ajax({
        url: link,
        success: function(data) {
            $('#insert').html(data);
        },
        complete: function() {
            setTimeout(worker, 60000);
        }
    });
})();
</script>
@endpush

@section('content')
<div class="row">
    <div id="insert" class="panel-body">

    </div>
</div>

<div class="navbar-fixed-bottom" id="menu_action">
    <div class="text-right action-wrapper">
        <a target="_blank" id="linkMenu" href="{{ route('system_team_create') }}" class="btn btn-success">Create Member
        </a>
        <a target="_blank" id="linkMenu" href="{{ route('reservation_booking_create') }}" class="btn btn-primary">Create
            Booking
        </a>
    </div>
</div>
@endsection