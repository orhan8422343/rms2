   <!--======bakery theme common page  js---->
   <!-- Jquery JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/jquery.min.js') }}"></script>
   <!-- Bootstrap JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/bootstrap.min.js') }}"></script>

   <!-- Lazysizes -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/lazysizes.min.js') }}"></script>
   <!-- AOS JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/vendors/aos.min.js') }}"></script>
   <!-- Main script JS -->
   <script src="{{ asset('assets/front/bakery/assets/js/header.js') }}"></script>
   <script src="{{ asset('assets/front/bakery/assets/js/script.js') }}"></script>

   @if ($rtl == 1)
   <script src="{{ asset('assets/front/bakery/assets/js/rtl-script.js')}}"></script>
   @endif
   <script>
       jQuery.noConflict(true);
   </script>
