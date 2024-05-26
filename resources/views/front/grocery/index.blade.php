@extends('front.layout')
@section('style')
    @include('front.grocery.include.grocery_css')
@endsection
@section('content')
    <!--===Start Hero Section====--->
    @includeIf('front.grocery.heroSeaction')
    <!---===End Hero Section ==-->


        <!---Start Feature  Section--->
        @if ($bs->feature_section == 1)
        @includeIf('front.grocery.featureSection')
    @endif
    <!---end Feature Section-->


    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.grocery.introSection')
    @endif
    <!---end Intro Section-->



    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.grocery.categoryProductSection')
    @endif
    <!-- End menu Section -->


    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.grocery.specialSection')
    @endif
    <!--===End spaecial section === ---->

    <!---Start Testimonial Section ---->
    @if ($bs->testimonial_section == 1)
        @includeIf('front.grocery.testimoialSection')
    @endif
     <!---End Testimonial Section --==-->


    <!---Start Blog Section-->
    @if ($bs->news_section == 1)
        @includeIf('front.grocery.blogSection')
    @endif
    <!-- end Blog Section -->


@endsection
@section('script')
    @include('front.grocery.include.grocery_js')
@endsection
