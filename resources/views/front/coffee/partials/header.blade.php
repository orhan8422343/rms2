<header class="header-area header-2" data-aos="fade-down">
    <!-- Start mobile menu -->
    <div class="mobile-menu">
        <div class="container">
            <div class="mobile-menu-wrapper"></div>
        </div>
    </div>
    <!-- End mobile menu -->

    <div class="main-responsive-nav">
        <div class="container">
            <!-- Mobile Logo -->
            <div class="logo">
                <a href="{{ route('front.index') }}" target="_self" title="Superv">
                    <img src="{{ asset('assets/front/img/' . $bs->logo) }}" alt="Logo">
                </a>
            </div>
            <!-- Menu toggle button -->
            <button class="menu-toggler" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <!-- Logo -->
                @if($bs->logo)
                <a class="navbar-brand" href="{{ route('front.index') }}" target="_self" title="Superv">
                    <img src="{{ asset('assets/front/img/' . $bs->logo) }}" alt="Logo">
                </a>
                @endif
                <!-- Navigation items -->
                <div class="collapse navbar-collapse">
                    <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
                        @php
                            $links = json_decode($menus, true);
                            //   dd($links);
                        @endphp

                        @foreach ($links as $link)
                            @php
                                $href = getHref($link);
                            @endphp
                            <!---Level 1 links whick doesn't have dropdown--->
                            @if (!array_key_exists('children', $link))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $href }}">{{ $link['text'] }}</a>
                                </li>
                            @else
                                <!-- Level 1 Link which have dropdown Menu-->
                                <li class="nav-item">
                                    <a href="#" class="nav-link toggle">{{ $link['text'] }} <i
                                            class="fal fa-plus"></i></a>
                                    <ul class="menu-dropdown">
                                        @foreach ($link['children'] as $level2)
                                            @php
                                                $l2Href = getHref($level2);
                                            @endphp

                                            <li class="nav-item">

                                                <a class="nav-link  @if (array_key_exists('children', $level2)) toggle @endif  @if(url() == $l2Href) active @endif"
                                                    href="{{ $l2Href }}">{{ $level2['text'] }} @if (array_key_exists('children', $level2))
                                                        <i class="fal fa-plus"></i>
                                                    @endif </a>
                                                @php
                                                    if (array_key_exists('children', $level2)) {
                                                        create_other_theme_menu($level2);
                                                    }
                                                @endphp
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="more-option mobile-item">
                    @if (!empty($currentLang))
                        <div class="item">
                            <div class="language">
                                <select class="languageChange text-capitalize">
                                    @foreach ($langs as $key => $lang)
                                        <option value="{{ route('changeLanguage', $lang->code) }}"
                                            data-href="{{ route('changeLanguage', $lang->code) }}"
                                            {{ $lang->code == $currentLang->code ? 'selected' : '' }}>

                                            {{ convertUtf8($lang->name) }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @auth
                        <div class="item">
                            <a href="{{ route('user-dashboard') }}" class="btn-icon" target="_self" aria-label="User"
                                title="{{ __('Dashboard') }}">
                                <i class="fal fa-user-circle"></i>
                            </a>
                        </div>
                    @else
                        <div class="item">
                            <a href="{{ route('user.login') }}" class="btn-icon" target="_self" aria-label="User"
                                title="{{ __('Login') }}">
                                <i class="fal fa-sign-in"></i>
                            </a>
                        </div>

                    @endauth

                    <div class="item cart cartQuantity" id="cartQuantity">
                        <a href="{{ route('front.cart') }}" class="btn-icon pe-2" target="_self" aria-label="User"
                            title="User">
                            <i class="fal fa-shopping-bag"></i>
                            @php
                                $itemsCount = 0;
                                $cart = session()->get('cart');
                                if (!empty($cart)) {
                                    foreach ($cart as $p) {
                                        $itemsCount += $p['qty'];
                                    }
                                }
                            @endphp
                            <span class="badge rounded-pill bg-primary cart-quantity">{{ $itemsCount }}</span>
                        </a>
                    </div>
                    @if ($bs->website_call_waiter == 1)
                    <div class="item">
                        <a data-toggle="modal" data-target="#callWaiterModal" class="btn-icon" target="_self" title="{{ __('Call Waiter') }}"
                        data-tooltip="tooltip" data-bs-placement="top" data-bs-original-title="{{ __('Call Waiter') }}">
                            <i class="fal fa-bell"></i>
                        </a>
                    </div>
                  @endif
                    @if ($bs->is_quote)
                        <div class="item">
                            <a href="{{ route('front.reservation') }}" class="btn btn-md btn-primary rounded-pill"
                                title="{{ __('Reservation') }}" target="_self">{{ __('Reservation') }}</a>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>
</header>
<script>

</script>
