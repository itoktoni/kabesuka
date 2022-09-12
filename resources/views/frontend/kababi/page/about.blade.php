@extends(Helper::setExtendFrontend())

@section('content')

<section class="page-title page-title-inner">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">About Us</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="tf-section wrap-about-us-style4">
    <img class="iconbg_about style2" src="{{ Helper::frontend('img/about-us/iconbgabout.png') }}" alt="images">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg color-style1 cleafix">
                        <h2 class="heading-bg-style02 style3">About us</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms"
                            data-wow-duration="1200ms">why choose us</h4>
                        <p class="tf-sub-heading">Best foods for you & family</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-inner-content-box">
                    <h4 class="heading">{{ config('website.name') }}</h4>
                    <div class="sub-heading-style2">
                        Sed ut perspiciatis unde omnis natus error lutatem accusantium doloremque
                        laudantium totam rem apam eaquepsa quae abillo inventore veritatis quasi arctecto
                        beatae vitae
                        dicta sunt explicabo. Nemo enim ipsamya voluptatem quia voluptas sit aspernatur aut
                        odifugi sed quia consequuntur
                        magni dolores eos qui ratioluptatem sequi nesciunt.
                        Neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur
                    </div>
                    <div class="flat-button flat-button-style2">
                        <a href="our-shop.html" class="tf-button color-style1">discover more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="about-inner-image-box flex">
                    <div class="image wow fadeIn animated" data-wow-delay="0.2ms" data-wow-duration="1300ms">
                        <img src="{{ Helper::frontend('img/about-us/img1about.jpg') }}" alt="images">
                    </div>
                    <div class="about-box-list">
                        <h6 class="heading">
                            Quis autem veleum reprehe
                            voluptate velit esse nuam nims
                            stiae consequatur velillum
                        </h6>
                        <ul class="list-benefit">
                            <li>Fresh Products</li>
                            <li>Professionals & Skilled Chefs</li>
                            <li>Best Offer & Low Cost Bar</li>
                            <li>Vegan Cuisine</li>
                            <li class="last-child">Online Delivery Shop</li>
                        </ul>
                        <div class="box box-countter-chefs flex wow fadeInUp animated" data-wow-delay="0.2ms"
                            data-wow-duration="1300ms">
                            <div class="icon">
                                <i class="fal fa-heart"></i>
                            </div>
                            <div class="countter-box">
                                <span class="number" data-from="0" data-to="3025" data-speed="2500"
                                    data-inviewport="yes">3025</span><span>+</span>
                                <h6 class="sub-heading-style2">Saticfied Customers</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tf-section counter-chefs-about">
    <div class="overlay-inner"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="wrap-counter wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                <div class="col-box col-25">
                    <div class="box box-countter-chefs text-center padding-right-121">
                        <div class="wrap-icon">
                            <i class="flaticon-chef"></i>
                        </div>
                        <div class="countter-box margin-top-3">
                            <h6 class="heading">Professional Chefs</h6>
                            <span class="number" data-from="0" data-to="309" data-speed="2500"
                                data-inviewport="yes">309</span>
                        </div>
                    </div>
                </div>
                <div class="col-box col-25">
                    <div class="box box-countter-chefs text-center padding-right-73">
                        <div class="wrap-icon">
                            <i class="flaticon-fast-food"></i>
                        </div>
                        <div class="countter-box">
                            <h6 class="heading">Items Of Foods</h6>
                            <span class="number" data-from="0" data-to="453" data-speed="2500"
                                data-inviewport="yes">453</span>
                        </div>
                    </div>
                </div>
                <div class="col-box col-25">
                    <div class="box box-countter-chefs text-center padding-right-5">
                        <div class="wrap-icon">
                            <i class="flaticon-fork"></i>
                        </div>
                        <div class="countter-box">
                            <h6 class="heading">Years Of Experience</h6>
                            <span class="number" data-from="0" data-to="64" data-speed="2500"
                                data-inviewport="yes">64</span><span class="sub-number">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-box col-25 no-pd-right">
                    <div class="box box-countter-chefs text-center padding-left-106">
                        <div class="wrap-icon">
                            <i class="flaticon-pizza-1"></i>
                        </div>
                        <div class="countter-box">
                            <h6 class="heading">Saticfied Customers</h6>
                            <span class="number" data-from="0" data-to="302" data-speed="2500"
                                data-inviewport="yes">302</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection