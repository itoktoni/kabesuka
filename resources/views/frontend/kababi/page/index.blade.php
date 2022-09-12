@extends(Views::frontend())

@push('css')
<style>
@foreach($sliders as $slider)
.slider-style3 .image-slider3.slide{{ $slider->marketing_slider_id }} {background: url(../public/files/slider/{{ $slider->marketing_slider_image }}) no-repeat center center;}
@endforeach
</style>

@endpush

@push('javascript')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(".date").flatpickr({
    altInput: true,
    altFormat: "j F Y",
    dateFormat: "Y-m-d",
});
</script>

@endpush

@section('content')

<section class="page-title page-title-style3">
    <div class="slider slider-style3">
        <div class="swiper-container mainslider">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div class="slider-item">
                        <div class="image-slider3 slide{{ $slider->marketing_slider_id }}">
                            <div class="wrap-image">
                                <div class="overlay-image"></div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="page-tittle-slider distance">

                                <div class="content-slider">
                                    <div class="heading-tittle">
                                        <div class="sub-title">
                                            <p>{{ $slider->marketing_slider_name }}</p>
                                        </div>
                                        <h1 class="title margin-4 margin-bt21 color-style4">
                                            {{ $slider->marketing_slider_description }}
                                        </h1>
                                        <div class="flat-button flat-button-style2">
                                            <a href="{{ $slider->marketing_slider_link }}" class="tf-button color-text color-style2">
                                                {{ $slider->marketing_slider_button }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next btn-slide-next"></div>
            <div class="swiper-button-prev btn-slide-prev active"></div>
        </div>
    </div>
</section>

<section id="booking" class="tf-section wrap-booking wrap-booking-style03">
    <div class="container-fluid">
        <div class="row">

            <div class="error">

            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach

            </div>

            <div class="wrap-form-style03">
            <form method="POST" class="comment-form comment-form-style03" action="{{ route('booking') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <fieldset class="phone-wrap ">
                        <input type="text" id="phone" placeholder="Name" class="tb-my-input" name="name"
                            tabindex="1" value="{{ auth()->check() ? auth()->user()->name : '' }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="phone-wrap ">
                        <input type="text" id="phone" placeholder="Phone Number" class="tb-my-input" name="phone"
                            tabindex="2" value="{{ auth()->check() ? auth()->user()->phone : '' }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="email-wrap ">
                        <input type="email" id="email" placeholder="Email Address" class="tb-my-input" name="email"
                            tabindex="1" value="{{ auth()->check() ? auth()->user()->email : '' }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="select ">
                        <select name="qty" id="persons" required="">
                            <option value="">Persons</option>
                            <option value="1">1 Persons</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                            <option value="5">5 Persons</option>
                            <option value="6">6 Persons</option>
                            <option value="7">7 Persons</option>
                            <option value="8">8 Persons</option>
                            <option value="8">8 Persons</option>
                            <option value="8">8 Persons</option>
                            <option value="9">9 Persons</option>
                            <option value="10">10 Persons</option>
                        </select>
                    </fieldset>
                    <fieldset class="phone-wrap ">
                        <input type="text" placeholder="Date" value="{{ date('Y-m-d') }}" class="tb-my-input date" name="date"
                            tabindex="1" value="">
                    </fieldset>
                    <fieldset class="phone-wrap ">
                        <select name="time" id="time-booking">
                            @foreach($jam as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset style="float:right" class="btn-submit text-center flat-button flat-button-style3">
                        <button id="comment-reply" name="submit" class="tf-button color-text color-style1"
                            type="submit">
                            booking now
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="tf-section wrap-category-style03">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg cleafix">
                        <h2 class="heading-bg-style02 style2 magin-left-12 ">{{ env('SECTION_HEADER_1_HEAD') }}</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style3 wow zoomIn animated" data-wow-delay="0.3ms"
                            data-wow-duration="1200ms">{{ env('SECTION_HEADER_1_TITLE') }}</h4>
                        <p class="tf-sub-heading color-style4">{{ env('SECTION_HEADER_1_DESC') }}</p>
                    </div>
                </div>
            </div>
            @foreach($data_category->chunk(2) as $categories)
            <div class="col-md-3">
                <div class="category-box padding-top15">
                    @foreach($categories as $category)
                    <div class="category-inner wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1000ms">
                        <div class="image">
                            <img src="{{ Helper::files('category/'.$category->category_image) }}" alt="{{ $category->category_name}}">
                        </div>
                        <div class="content-title">
                            <h4 class="heading">
                                {{ $category->category_name }}
                            </h4>
                        </div>
                        <div class="imagebox-content">
                            <h4 class="heading color-style4">
                                {{ $category->category_name }}
                            </h4>
                            <p>{{ $category->category_description }}</p>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="tf-section wrap-our-menu-style03">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg cleafix">
                        <h2 class="heading-bg-style02">{{ env('SECTION_HEADER_2_HEAD') }}</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style3 wow zoomIn animated" data-wow-delay="0.3ms"
                            data-wow-duration="1200ms">{{ env('SECTION_HEADER_2_TITLE') }}</h4>
                        <p class="tf-sub-heading color-style4">{{ env('SECTION_HEADER_2_DESC') }}</p>
                    </div>
                </div>
            </div>

            @foreach($data_product->chunk(2) as $products)
            <div class="col-md-6">
                <div class="col-{{ $loop->odd ? 'left' : 'right' }}-ourmenu">
                    @foreach($products as $product)
                    <div class="our-menu-box">
                        <div class="our-menu-item our-menu-item-style02  wow fadeInUp animated"
                            data-wow-delay="0.2ms" data-wow-duration="1200ms">
                            <div class="image">
                                <img class="image-inner" src="{{ Helper::files('product/'.$product->product_image) }}"
                                    alt="images">
                            </div>
                            <div class="content-menu-item">
                                <h4 class="heading">{{ $product->product_name }}</h4>
                                <div class="sub-heading">{!! $product->product_description !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="btn-button">
                <div class="flat-button flat-button-style3">
                    <a href="{{ env('SECTION_HEADER_3_LINK') }}" class="tf-button color-text color-style1 popup-youtube">{{ env('SECTION_HEADER_3_TITLE') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection