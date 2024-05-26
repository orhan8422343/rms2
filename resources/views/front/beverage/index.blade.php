@extends('front.layout')
@section('style')
    @include('front.beverage.include.beverage_css')
@endsection
@section('content')
    <!--===Start Hero Section====--->
    @includeIf('front.beverage.heroSeaction')

    <!---===End Hero Section ==-->

    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.beverage.introSection')
    @endif
    <!---end Intro Section-->


    <!---Start Feature  Section--->
    @if ($bs->feature_section == 1)
        @includeIf('front.beverage.featureSection')
    @endif
    <!---end Feature Section-->

    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.beverage.categoryProductSection')
    @endif
    <!-- End menu Section -->
    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.beverage.specialSection')
    @endif
    <!--===End spaecial section --==-->

    <!-- Testimonial-blog-area start -->
    <div class="testimonial-blog-area bg-img" data-bg-image="{{ asset('assets/front/img/' . $be->testimonial_bg_img) }}">

        <!-- Start Testimonial Section -->
        @if ($bs->testimonial_section == 1)
            @includeIf('front.beverage.testimoialSection')
        @endif
        <!-- End Testimonial Section -->


        <!---Start Blog Section-->
        @if ($bs->news_section == 1)
            @includeIf('front.beverage.blogSection')
        @endif
        <!--- End Blog Section -->

    </div>
    <!-- End Testimonial-Blag Section--->
@endsection

@section('script')
    @include('front.beverage.include.beverage_js')
@endsection
