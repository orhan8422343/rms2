

<link rel="stylesheet" href="{{ asset('assets/front/multipurpose/css/style.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/front/multipurpose/css/styles.php?color=' . str_replace('#', '', $bs->base_color)) }}">

<!--===== Common css ==-->



{{-- @if ($bs->theme == 'bakery' &&  $rtl == 1)
<link rel="stylesheet" href="{{ asset('assets/front/bakery/assets/css/rtl.css') }}">
@endif --}}

<!--===direction --->
@if ($bs->theme == 'multipurpose' && $rtl == 1)
    <link rel="stylesheet" href="{{ asset('assets/front/multipurpose/css/rtl.css') }}">
@endif

@if ($bs->theme == "multipurpose" && ($bs->is_tawkto == 1 || $bs->is_whatsapp == 1))
    <style>
        .go-top-area .go-top.active {
            right: auto;
            left: 20px;
        }
    </style>
@endif
