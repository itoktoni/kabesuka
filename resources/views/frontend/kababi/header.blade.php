<header id="site-header" class="site-header-style3">
    <div id="site-header-inner" class="container-fluid">
        <div class="wrap-inner flex">
            <div id="site-logo" class="cleafix">
                <a class="logo" href="{{ env('APP_URL') }}">
                    <img class="logo" src="{{ Helper::files('logo/'.env('WEBSITE_LOGO')) }}"
                        alt="{{ env('WEBSITE_NAME') }}">
                </a>
            </div>
            <div class="mobile-button">
                <span></span>
            </div>
            <nav id="main-nav" class="main-nav">
                <ul id="menu-primary-menu" class="menu">
                    <li class="menu-item {{ empty(request()->segment(1)) ? 'current-menu-item' : '' }}">
                        <a href="{{ url('/') }}">Home</a>
                    </li>

                    @if($public_page)
                    @foreach($public_page->where('marketing_page_status', PageType::Header) as $page)
                        <li>
                            <a class="menu-item {{ request()->segment(2) == $page->marketing_page_slug ? 'current-menu-item' : '' }}"  href="{{ route('page', ['slug' => $page->marketing_page_slug]) }}">
                                {{ $page->marketing_page_name }}
                            </a>
                        </li>
                        @endforeach
                    @endif

                    @auth
                    <li class="menu-item {{ request()->segment(1) == 'account' ? 'current-menu-item' : '' }}">
                        <a href="{{ route('account') }}">Account</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('logout') }}">Logout</a>
                    </li>
                    @else
                    <li class="menu-item">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @endauth

                    <li class="menu-item">
                        <a target="_blank" href="{{ Helper::files('menu.pdf') }}">Menu</a>
                    </li>

                </ul>
            </nav>
            <div class="flat-button flat-button-style3">
                <a href="{{ url('/') }}#booking" class="tf-button color-text color-style1">{{ env('BOOKING_TABLE') }}</a>
            </div>
        </div>
    </div>
</header>