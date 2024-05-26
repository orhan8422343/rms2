@extends('front.layout')
@section('style')
    @include('front.pizza.include.pizza_css')
@endsection

@section('content')
    <!-- Home-area start-->
    <!--===Start Hero Section====--->
    @includeIf('front.pizza.heroSeaction')
    <!---===End Hero Section ==-->

    <!---Start Feature  Section--->
    @if ($bs->feature_section == 1)
        @includeIf('front.pizza.featureSection')
    @endif
    <!---end Feature Section-->

    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.pizza.introSection')
    @endif
    <!---end Intro Section-->

    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.pizza.categoryProductSection')
    @endif
    <!-- End menu Section -->

    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.pizza.specialSection')
    @endif
    <!--===End spaecial section --==-->

    @if ($bs->testimonial_section == 1)
        @includeIf('front.pizza.testimoialSection')
    @endif

    <!---Start Blog Section-->
    @if ($bs->news_section == 1)
        @includeIf('front.pizza.blogSection')
    @endif
@endsection

@section('script')
    @include('front.pizza.include.pizza_js')
@endsection
