
<header class="header-area">
    <div class="navigation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="support-bar">
                        <div class="row">
                            <div class="col-xl-6 d-none d-xl-block">
                                <div class="infos">
                                    <span><i class="fas fa-envelope-open-text"></i>
                                        {{ convertUtf8($bs->support_email) }}</span>
                                    <span><i class="fas fa-phone-alt"></i>
                                        {{ convertUtf8($bs->support_phone) }}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 col-12">
                                <div class="links">
                                    @if (!empty($socials))
                                        <ul class="social-links">
                                            @foreach ($socials as $social)
                                                <li><a href="{{ $social->url }}" target="_blank"><i
                                                            class="{{ $social->icon }}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if (!empty($currentLang))
                                        <div class="language">
                                            <a class="language-btn" href="#"><i class="fas fa-globe-asia"></i>
                                                {{ convertUtf8($currentLang->name) }}</a>
                                            <ul class="language-dropdown">
                                                @foreach ($langs as $key => $lang)
                                                    <li><a
                                                            href='{{ route('changeLanguage', $lang->code) }}'>{{ convertUtf8($lang->name) }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @guest
                                        <ul class="login">
                                            <li><a href="{{ route('user.login') }}">{{ __('Login') }}</a></li>
                                        </ul>
                                    @endguest
                                    @auth
                                        <ul class="login">
                                            <li><a href="{{ route('user-dashboard') }}">{{ __('Dashboard') }}</a>
                                            </li>
                                        </ul>
                                    @endauth
                                    <div id="cartQuantity" class="cart cartQuantity">
                                        <a href="{{ route('front.cart') }}">
                                            <i class="fas fa-cart-plus"></i>
                                            @php
                                                $itemsCount = 0;
                                                $cart = session()->get('cart');
                                                if (!empty($cart)) {
                                                    foreach ($cart as $p) {
                                                        $itemsCount += $p['qty'];
                                                    }
                                                }
                                            @endphp
                                            
                                            <span class="cart-quantity">{{ $itemsCount }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('front.index') }}">
                            <img src="{{ asset('assets/front/img/' . $bs->logo) }}" alt="Logo">
                        </a> <!-- logo -->

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarFive" aria-controls="navbarFive" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button> <!-- navbar toggler -->
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarFive">
                            <ul class="navbar-nav m-xl-auto mr-auto">
                                @php
                                    $links = json_decode($menus, true);
                                    //   dd($links);
                                @endphp

                                @foreach ($links as $link)
                                    @php
                                        $href = getHref($link);
                                    @endphp

                                    @if (!array_key_exists('children', $link))
                                        {{-- - Level1 links which doesn't have dropdown menus - --}}
                                        <li class="nav-item"><a class="page-scroll" href="{{ $href }}"
                                                target="{{ $link['target'] }}">{{ $link['text'] }}</a>
                                        </li>
                                    @else
                                        {{-- - Level1 links which has dropdown menus - --}}
                                        <li class="nav-item"><a class="page-scroll" href="{{ $href }}"
                                                target="{{ $link['target'] }}">{{ $link['text'] }} <i
                                                    class="fa fa-angle-down"></i></a>


                                            {{-- START: 2nd level links --}}
                                            <ul class="sub-menu">
                                                @foreach ($link['children'] as $level2)
                                                    @php
                                                        $l2Href = getHref($level2);
                                                    @endphp
                                                    <li
                                                        class="nav-item @if (array_key_exists('children', $level2)) submenus @endif">
                                                        <a class="page-scroll" href="{{ $l2Href }}"
                                                            target="{{ $level2['target'] }}">{{ $level2['text'] }}</a>

                                                        {{-- START: 3rd Level links --}}
                                                        @php
                                                            if (array_key_exists('children', $level2)) {
                                                                create_menu($level2);
                                                            }
                                                        @endphp
                                                        {{-- END: 3rd Level links --}}

                                                    </li>
                                                @endforeach
                                            </ul>
                                    @endif
                                @endforeach


                                @if ($bs->is_quote)
                                    <li class="nav-item d-block d-sm-none"><a class="page-scroll"
                                            href="{{ route('front.reservation') }}">{{ __('Reservation') }}</a>
                                    </li>
                                @endif
                                @if ($bs->website_call_waiter == 1)
                                    <li class="nav-item d-block d-sm-none"><a class="page-scroll"
                                            data-toggle="modal"
                                            data-target="#callWaiterModal">{{ __('Call Waiter') }}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>

                        <div class="navbar-btns d-flex align-items-center">
                            <div class="header-times">
                                <i class="flaticon-time"></i>
                                <span>{{ __('Opening Time') }}</span>
                                <p>{{ $bs->office_time }}</p>
                            </div>
                            @if ($bs->is_quote)
                                <a class="main-btn main-btn-2 d-none d-sm-inline-block"
                                    href="{{ route('front.reservation') }}">{{ __('Reservation') }}</a>
                            @endif
                            @if ($bs->website_call_waiter == 1)
                                <a class="main-btn main-btn d-none d-sm-inline-block text-white ml-2"
                                    data-toggle="modal"
                                    data-target="#callWaiterModal">{{ __('Call Waiter') }}</a>
                            @endif
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
</header>

