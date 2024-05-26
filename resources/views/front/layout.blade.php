<!doctype html>
<html lang="en" @if ($rtl == 1) dir="rtl" @endif>

<head>
    {{-- -Start of Google Analytics script --}}
    @if ($bs->is_analytics == 1)
        {!! $bs->google_analytics_script !!}
    @endif
    {{-- -End of Google Analytics script --}}

    {{-- -====== Required meta tags ====== --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- -====== Title ====== --}}
    <title>{{ $bs->website_title }}</title>

    {{-- -====== Favicon Icon ====== --}}
    <link rel="shortcut icon" href="{{ asset('assets/front/img/' . $bs->favicon) }}" type="image/png">

    {{-- --=========Plugin common css===========- --}}
    @include('front.plugin_css')

    @include('front.themes_css')

    @yield('style')

    {{-- -=====Theme wise Header & Footer css == --}}
    @include('front.themes_header_footer_css')

    <link rel="stylesheet" href="{{ asset('assets/front/plugin_css/styles.php?color=' . str_replace('#', '', $bs->base_color)) }}">
    {{-- --========Theme wise End Header & Footer css=======-- --}}

    {{-- ---==================== Common js=======================---- --}}
    @include('front.plugin_js')
    {{-- --============= Common js===========================--- --}}

</head>

@php
    $bodyClass = '';
    if ($activeTheme == 'bakery') {
        $bodyClass = 'theme-dark';
    }
@endphp

<body class="{{ $bodyClass }}">

    {{-- -====== PRELOADER PART START ====== --}}
    @if ($bs->preloader_status == 1)
        <div id="preloader">
            <div class="loader revolve">
                <img src="{{ asset('assets/front/img/' . $bs->preloader) }}" alt="">
            </div>
        </div>
    @endif
    {{-- -====== PRELOADER PART ENDS ====== --}}

    {{-- Loader --}}
    <div class="request-loader" id="">
        <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
    </div>
    {{-- Loader --}}

    {{-- -======Theme wise  HEADER PART START ====== --}}
    @include('front.themes_header')
    {{-- -======Theme wise HEADER PART ENDS ====== --}}

    @yield('content')

    {{-- -====== FOOTER PART START ====== --}}
    @include('front.themes_footer')
    {{-- -====== FOOTER PART ENDS ====== --}}

    {{-- Popups start --}}
    @includeIf('front.partials.popups')
    {{-- Popups end --}}

    {{-- Variation Modal Starts --}}
    @includeIf('front.partials.variation-modal')
    {{-- Variation Modal Ends --}}

    {{-- -====== GO TO TOP PART START ====== --}}
    @if ($activeTheme == 'multipurpose')
        <div class="go-top-area">
            <div class="go-top-wrap">
                <div class="go-top-btn-wrap">
                    <div class="go-top go-top-btn">
                        <i class="fa fa-angle-double-up"></i>
                        <i class="fa fa-angle-double-up"></i>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- -- other theme- --}}
        <div class="go-top"><i class="fal fa-angle-up"></i></div>
    @endif

    {{-- -====== GO TO TOP PART ENDS ====== --}}

    {{-- WhatsApp Chat Button --}}
    <div id="WAButton"></div>

    {{-- Cookie alert dialog start --}}
    <div class="cookie">
        @include('cookie-consent::index')
    </div>
    {{-- Cookie alert dialog end --}}

    {{-- -- Themes  Moda Part-- --}}
    @include('front.themes_model')

    <script>
        "use strict";
        var mainurl = "{{ url('/') }}";
        var lat = '{{ $bs->latitude }}';
        var lng = '{{ $bs->longitude }}';
        var rtl = {{ $rtl }};
        var position = "{{ $be->base_currency_symbol_position }}";
        var symbol = "{{ $be->base_currency_symbol }}";
        var textPosition = "{{ $be->base_currency_text_position }}";
        var currText = "{{ $be->base_currency_text }}";
        var vap_pub_key = "{{ env('VAPID_PUBLIC_KEY') }}";
        var select = "{{ __('Select') }}";
    </script>

    {{-- ------------==================Common js=============== - --}}

    @include('front.themes_js')


    {{-- ---========Theme wise Start Header and Footer  js---------------- --}}
    @include('front.themes_header_footer_js')
    {{-- ---======== End Header and Footer  js---------------- --}}
    @yield('script')
    {{-- ----------------- All Page requied Common js  ---------------------------- --}}

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    {{-- whatsapp init code --}}
    @if ($bs->is_whatsapp == 1)
        <script type="text/javascript">
            var whatsapp_popup = {{ $bs->whatsapp_popup }};
            var whatsappImg = "{{ asset('assets/front/img/whatsapp.svg') }}";
            $(function() {
                $('#WAButton').floatingWhatsApp({
                    phone: "{{ $bs->whatsapp_number }}", //WhatsApp Business phone number
                    headerTitle: "{{ $bs->whatsapp_header_title }}", //Popup Title
                    popupMessage: `{!! nl2br($bs->whatsapp_popup_message) !!}`, //Popup Message
                    showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
                    buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
                    position: "right" //Position: left | right

                });
            });
        </script>
    @endif


    @if (session()->has('success'))
        <script>
            "use strict";
            toastr["success"]("{{ __(session('success')) }}");
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            "use strict";
            toastr["warning"]("{{ __(session('warning')) }}");
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            "use strict";
            toastr["error"]("{{ __(session('error')) }}");
        </script>
    @endif

    {{-- -Start of Tawk.to script --}}
    @if ($bs->is_tawkto == 1)
        {!! $bs->tawk_to_script !!}
    @endif
    {{-- -End of Tawk.to script --}}

    {{-- -Start of AddThis script --}}
    @if ($bs->is_addthis == 1)
        {!! $bs->addthis_script !!}
    @endif
    {{-- -End of AddThis script --}}

</body>

</html>
