<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
{{-- bootstrap popper js --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

<!--====== Plugin min js ======-->
<script src="{{ asset('assets/front/js/plugin.min.js') }}"></script>

@if($activeTheme == 'multipurpose')
<!--====== Push Notification js ======-->
<script src="{{ asset('assets/front/multipurpose/js/pwa.js') }}" defer></script>
<!--====== Misc js ======-->
<script src="{{ asset('assets/front/multipurpose/js/misc.js') }}"></script>
<!--====== Main js ======-->
<script src="{{ asset('assets/front/multipurpose/js/main.js') }}"></script>
@endif

@if($activeTheme != 'multipurpose')
<script src="{{ asset('assets/front/js/pwa.js') }}" defer></script>
<!--====== Misc js ======-->
<script src="{{ asset('assets/front/js/misc.js') }}"></script>
<!--====== Main js ======-->
<script src="{{ asset('assets/front/js/main.js') }}"></script>
@endif

<!--====== Cart js ======-->
<script src="{{ asset('assets/front/js/cart.js') }}"></script>

@if($activeTheme != "multipurpose")
{{------Language Change---}}
<script src="{{ asset('assets/front/js/themes-main.js') }}"></script>
@endif

