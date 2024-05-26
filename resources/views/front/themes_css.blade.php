@if (count($langs) == 0)
<style media="screen">
    .support-bar-area ul.social-links li:last-child {
        margin-right: 0px;
    }

    .support-bar-area ul.social-links::after {
        display: none;
    }
</style>
@endif

@if ($bs->feature_section == 0)
<style media="screen">
    .hero-txt {
        padding-bottom: 160px;
    }
</style>
@endif

<!--========= common css ============--->
@if ($activeTheme == 'multipurpose' || !request()->routeIs('front.index'))
<link rel="stylesheet" href="{{ asset('assets/front/multipurpose/css/style.css') }}">
@endif

<!--========= rtl css ============--->
@if ($activeTheme == 'multipurpose' && $rtl == 1)
<link rel="stylesheet" href="{{ asset('assets/front/multipurpose/css/rtl.css') }}">
@endif

<!--========= common rtl css ============--->
@if ($rtl == 1)
<link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
@endif

@if ($activeTheme == 'multipurpose' && ($bs->is_tawkto == 1 || $bs->is_whatsapp == 1))
<style>
    .go-top-area .go-top.active {
        right: auto;
        left: 20px;
    }
</style>
@endif
