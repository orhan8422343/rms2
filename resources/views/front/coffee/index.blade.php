@extends('front.layout')
@section('style')
    @include('front.coffee.include.coffee_css')
@endsection
@section('content')
    <!--===Start Hero Section====--->
    @includeIf('front.coffee.heroSeaction')

    <!---===End Hero Section ==-->

    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.coffee.introSection')
    @endif
    <!---end Intro Section-->


    <!---Start Feature  Section--->
    @if ($bs->feature_section == 1)
        @includeIf('front.coffee.featureSection')
    @endif
    <!---end Feature Section-->

    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.coffee.categoryProductSection')
    @endif
    <!-- End menu Section -->
    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.coffee.specialSection')
    @endif
    <!--===End spaecial section --==-->

    <!-- Testimonial-blog-area start -->
    <div class="testimonial-blog-area bg-img" data-bg-image="{{ asset('assets/front/img/' . $be->testimonial_bg_img) }}">

        <!-- Start Testimonial Section -->
        @if ($bs->testimonial_section == 1)
            @includeIf('front.coffee.testimoialSection')
        @endif
        <!-- End Testimonial Section -->


        <!---Start Blog Section-->
        @if ($bs->news_section == 1)
            @includeIf('front.coffee.blogSection')
        @endif
        <!--- End Blog Section -->

    </div>
@endsection

@section('script')
    @include('front.coffee.include.coffee_js')
@endsection
