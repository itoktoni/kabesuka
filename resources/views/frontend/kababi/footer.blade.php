<footer id="footer" class="footer-style03">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="widget widget-infor widget-footer">
                    <div id="site-logo3" class="cleafix" style="margin-top:-30px">
                        <a href="index.html" class="logo">
                            <img src="{{ Helper::frontend('img/logo/logo.png') }}" alt="">
                        </a>
                    </div>
                    <p class="sub-heading-style2" style="margin-left: 50px;margin-top:-20px">Posum dolor sit amet,
                        consectetur adipiscing elit sed do
                        {{ env('WEBSITE_DESCRIPTION') }}
                    </p>
                    <ul class="widget_socials" style="margin-left: 50px;">
                        @foreach($public_sosmed as $sosmed)
                        <li><a href="{{ $sosmed->marketing_sosmed_link }}"><i
                                    class="fab fa-{{ $sosmed->marketing_sosmed_icon }}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-2">
                <div class="widget widget-link widget-about widget-footer ">
                    <h4 class="widget-title">Page</h4>
                    <ul class="widget-list">
                        @foreach($public_page->where('marketing_page_status', PageType::Footer) as $page)
                        <li>
                            <a href="{{ route('page', ['slug' => $page->marketing_page_slug]) }}">
                                {{ $page->marketing_page_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget widget-link widget-contact widget-footer">
                    <h4 class="widget-title">Contact</h4>
                    <ul class="widget-list">
                        <li class="adress margin-right-15">
                            {{ env('WEBSITE_ADDRESS') }}
                        </li>
                        <li class="mail">
                            <a href="mailto:{{ env('WEBSITE_EMAIL') }}">
                                {{ env('WEBSITE_EMAIL') }}
                            </a>
                        </li>
                        <li class="phone">{{ env('WEBSITE_PHONE') }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>