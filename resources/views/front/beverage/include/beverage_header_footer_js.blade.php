<script src=" {{asset('assets/front/beverage/assets/js/vendors/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src=" {{asset('assets/front/beverage/assets/js/vendors/bootstrap.min.js')}}"></script>
<!-- Lazysizes -->
<script src=" {{asset('assets/front/beverage/assets/js/vendors/lazysizes.min.js')}}"></script>
<!-- AOS JS -->
<script src=" {{asset('assets/front/beverage/assets/js/vendors/aos.min.js')}}"></script>
<!-- Main script JS -->
<script src=" {{asset('assets/front/beverage/assets/js/header.js')}}"></script>
<script src=" {{asset('assets/front/beverage/assets/js/script.js')}}"></script>


@if ($rtl == 1)
    <script src="{{ asset('assets/front/beverage/assets/js/rtl-script.js') }}"></script>
@endif

<script>
    jQuery.noConflict(true);
</script>
