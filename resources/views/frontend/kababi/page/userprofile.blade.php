@extends(Views::frontend())

@section('content')

<div class="tf-section product-details">
    <div class="container-fluid">
        <div class="row">

            <div class="container tf-heading ">
                <h4 class="tf-title tf-title-style3 text-center mt-5">My Profile</h4>

                @if(session()->has('success'))
                <div style="margin-top:-20px;" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data Berhasil di Update !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if ($errors)
                @foreach ($errors->all() as $error)
                <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </strong>
                </div>
                @endforeach
                @endif

            </div>

            <div class="col-md-12">
                <div id="comments" class="comments-area">

                    <div id="respond" class="comment-respond">
                        {!!Form::open(['route' => 'account', 'class' => 'comment-form comment-form-style2', 'files' =>
                        true])
                        !!}

                        <fieldset class="name active">
                            <label for="">Name</label>
                            <input type="text" id="name" placeholder="Full Name" class="tb-my-input" name="name"
                                tabindex="2" value="{{ old('name') ?? Auth::user()->name ?? '' }}" aria-required="true"
                                required="">
                        </fieldset>
                        <fieldset class="phone">
                            <label for="">Phone</label>
                            <input type="number" id="phone" placeholder="Phone Number" class="tb-my-input" name="phone"
                                tabindex="2" value="{{ old('phone') ?? Auth::user()->phone ?? '' }}"
                                aria-required="true" required="">
                        </fieldset>
                        <fieldset class="email">
                            <label for="">Email</label>
                            <input type="email" id="email" placeholder="Email Address " class="tb-my-input" name="email"
                                tabindex="2" value="{{ old('email') ?? Auth::user()->email ?? '' }}"
                                aria-required="true" required="">
                        </fieldset>
                        <fieldset class="name">
                            <label for="">Birthday</label>
                            <input type="text" id="name" placeholder="Full Name" class="tb-my-input" name="birth"
                                tabindex="2" value="{{ old('birth') ?? Auth::user()->birth ?? '' }}" aria-required="true"
                                required="">
                        </fieldset>
                        <fieldset class="phone">
                            <label for="">Change Password</label>
                            <input style="border: 2px solid rgba(9, 12, 15, 0);background-color: rgba(9, 12, 15, 0.05);padding: 15px 21px 15px 29px;font-size: 18px;line-height: 24px;font-weight: 600;" type="password" id="phone" placeholder="To change password" class="tb-my-input" name="password"
                                tabindex="2" value=""
                                aria-required="true">
                        </fieldset>
                        <fieldset class="email">
                            <label for="">Point</label>
                            <input type="text" id="email" placeholder="Email Address " class="tb-my-input" name="total"
                                tabindex="2" value="{{ old('point') ?? Auth::user()->point ?? '' }}"
                                aria-required="true" required="">
                        </fieldset>
                        <div class="btn-submit flat-button flat-button-style2" style="float: right;">
                            <div class="btn-submit">
                                <button id="comment-reply" name="submit" class="tf-button color-text color-style1"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#force-responsive').DataTable();
});
</script>
@endpush

@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<style>
#force-responsive_wrapper {
    width: 100%;
}

#force-responsive_filter input {
    border: 0.5px solid #ced4da;
}

@media screen and (max-width: 520px) {
    table {
        width: 100% !important;
    }

    #force-responsive thead {
        display: none;
    }

    #force-responsive td {
        display: block;
        text-align: right;
        border-right: 1px solid #e1edff;
    }

    #force-responsive td::before {
        float: left;
        text-transform: uppercase;
        font-weight: bold;
        content: attr(data-header);
    }

    #force-responsive tr td:last-child {
        border-bottom: 2px solid #dddddd;
    }
}
</style>
@endpush