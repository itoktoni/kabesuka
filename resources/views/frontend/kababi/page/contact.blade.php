@extends(Helper::setExtendFrontend())

@section('content')

<section class="page-title page-title-inner">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">Contact Us</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="tf-section contact-us">
    <div class="container-fluid">
        <div class="row">

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            @if ($loop->first)
            <span class="help-block text-danger text-sm-left text-left">
                <strong>{{ $error }}</strong><br>
            </span>
            @endif
            @endforeach
            @endif

            <div class="col-box col-45">
                <div class="infor-contact border-style2">
                    <h4 class="heading">Contact Us</h4>
                    <div class="text">
                        Sit amet consectetur adipiscing elit sed eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.
                    </div>
                    <div class="widget widget-info flex">
                        <div class="icon icon-afress">
                            <i class="icon-kababimap"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Location</h6>
                            <p>55 Main Street, 2nd Block,</p>
                            <p>Melbourne, Australia</p>
                        </div>
                    </div>
                    <div class="widget widget-info flex">
                        <div class="icon icon-mail">
                            <i class="icon-kababiemail"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Email Address</h6>
                            <p><a href="https://themesflat.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="671412171708151327000a060e0b4904080a">[email&#160;protected]</a>
                            </p>
                            <p>www.kababiinfo.net</p>
                        </div>
                    </div>
                    <div class="widget widget-info style2 flex">
                        <div class="icon icon-call">
                            <i class="icon-kababicall"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Call Us</h6>
                            <p>+012 (345) 667 89</p>
                            <p>+12345678</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-box col-55">
                <div class="form-contact color-bg-style4">
                    <h4 class="heading">Leave a Message</h4>
                    <div class="text">We’re Ready To Help You</div>
                    {!!Form::open(['route' => 'contact', 'class' => 'comment-form comment-form-style2 style2', 'id' =>
                    'commentform']) !!}
                    <fieldset class="name">
                        <input type="text" id="name" placeholder="Full Name" class="tb-my-input"
                            name="marketing_contact_name" tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="email">
                        <input type="email" id="email" placeholder="Email Address " class="tb-my-input" name="marketing_contact_email"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="message">
                        <textarea id="message" name="marketing_contact_message" rows="5" placeholder="Write Message" tabindex="4"
                            aria-required="true" required=""></textarea>
                    </fieldset>
                    <div class="btn-submit flat-button flat-button-style2">
                        <button id="comment-reply" name="submit" class="tf-button color-style color-style1"
                            type="submit">
                            send message
                        </button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
<section class="tf-section map">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-map">
                    <iframe class="map-content wow fadeInUp animated"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4457.30210514409!2d144.9550716623184!3d-37.818421643591336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20%C3%9Ac!5e0!3m2!1svi!2s!4v1631871760998!5m2!1svi!2s"
                        width="1720" height="655" style="border: 0px; visibility: visible; animation-name: fadeInUp;"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection