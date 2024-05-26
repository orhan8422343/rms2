    <!--====== jquery js ======-->
    <script src="{{ asset('assets/front/multipurpose/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/multipurpose/js/vendor/jquery.3.2.1.min.js') }}"></script>
   
    

    @if ($bs->is_appzi == 1)
        <!-- Start of Appzi Feedback Script -->
        <script async src="https://app.appzi.io/bootstrap/bundle.js?token={{ $bs->appzi_token }}"></script>
        {!! $bs->appzi_script !!}
        <!-- End of Appzi Feedback Script -->
    @endif

    <!-- Start of Facebook Pixel Code -->
    @if ($be->is_facebook_pexel == 1)
        {!! $be->facebook_pexel_script !!}
    @endif
    <!-- End of Facebook Pixel Code -->

    @if ($bs->is_recaptcha == 1)
        <script type="text/javascript">
            var onloadCallback = function() {
                if ($("#g-recaptcha").length > 0) {
                    grecaptcha.render('g-recaptcha', {
                        'sitekey': '{{ $bs->google_recaptcha_site_key }}'
                    });
                }
            };
        </script>
    @endif
    <link rel="manifest" crossorigin="use-credentials" href="{{ asset('manifest.json') }}" />