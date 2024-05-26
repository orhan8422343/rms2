   <!---bakery theme In page js --->
   <!-- Jquery JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/jquery.min.js') }}"></script>
   <!-- Bootstrap JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/bootstrap.min.js') }}"></script>
   <!-- Counter JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/jquery.counterup.min.js') }}"></script>

   <!-- Magnific Popup JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
   <!-- Swiper Slider JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/swiper-bundle.min.js') }}"></script>
   <!-- Lazysizes -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/lazysizes.min.js') }}"></script>
   <!-- Mouse Hover JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/mouse-hover-move.js') }}"></script>
   <!-- Twinmax JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/tweenMax.min.js') }}"></script>
   <!-- AOS JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/aos.min.js') }}"></script>
   <!-- Main script JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/header.js') }}"></script>
   <script src="{{ asset('assets/front/bakery/assets/js/script.js') }}"></script>

   @if ($rtl == 1)
   <script src="{{ asset('assets/front/bakery/assets/js/rtl-script.js')}}"></script>
   @endif

   <script>
       jQuery.noConflict();
   </script>
