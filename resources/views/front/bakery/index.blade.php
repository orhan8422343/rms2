@extends('front.layout')
@section('style')
    @include('front.bakery.include.bakery_css')
@endsection
@section('content')
    <!--===Start Hero Section====--->
    @includeIf('front.bakery.heroSeaction')
    <!---===End Hero Section ==-->

    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.bakery.introSection')
    @endif
    <!---end Intro Section-->

    <!---Start Feature  Section--->
    @if ($bs->feature_section == 1)
        @includeIf('front.bakery.featureSection')
    @endif
    <!---end Feature Section-->

    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.bakery.categoryProductSection')
    @endif
    <!-- End menu Section -->

    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.bakery.specialSection')
    @endif
    <!--===End spaecial section === ---->

    <!---Start Testimonial Section ---->
    @if ($bs->testimonial_section == 1)
        @includeIf('front.bakery.testimoialSection')
    @endif
     <!---End Testimonial Section --==-->


    <!---Start Blog Section-->
    @if ($bs->news_section == 1)
        @includeIf('front.bakery.blogSection')
    @endif
    <!-- end Blog Section -->


@endsection
@section('script')
    @include('front.bakery.include.bakery_js')
@endsection
