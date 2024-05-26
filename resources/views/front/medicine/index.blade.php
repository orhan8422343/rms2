@extends('front.layout')
@section('style')
    @include('front.medicine.include.medicine_css')
@endsection
@section('content')
    <!--===Start Hero Section====--->
    @includeIf('front.medicine.heroSeaction')
    <!---===End Hero Section ==-->


    {{-- <div class="item cart" id="cartQuantity">
        <a href="{{ route('front.cart') }}" class="btn-icon pe-2" target="_self" aria-label="User" title="User">
            <i class="fal fa-shopping-bag"></i>
            @php
                $itemsCount = 0;
                $cart = session()->get('cart');
                if (!empty($cart)) {
                    foreach ($cart as $p) {
                        $itemsCount += $p['qty'];
                    }
                }
            @endphp
            <span class="badge rounded-pill bg-primary cart-quantity">{{ $itemsCount }}</span>
        </a>
    </div> --}}


        <!---Start Feature  Section--->
    @if ($bs->feature_section == 1)
        @includeIf('front.medicine.featureSection')
    @endif
    <!---end Feature Section-->
    <!---Start Intro Section--->
    @if ($bs->intro_section == 1)
        @includeIf('front.medicine.introSection')
    @endif
    <!---end Intro Section-->


    <!-- Start menu Section -->
    @if ($bs->menu_section == 1)
        @includeIf('front.medicine.categoryProductSection')
    @endif
    <!-- End menu Section -->


    <!--===Start spaecial section --==-->
    @if ($bs->special_section == 1)
        @includeIf('front.medicine.specialSection')
    @endif
    <!--===End spaecial section === ---->

    <!---Start Testimonial Section ---->
    @if ($bs->testimonial_section == 1)
        @includeIf('front.medicine.testimoialSection')
    @endif
     <!---End Testimonial Section --==-->


@endsection
@section('script')
    @include('front.medicine.include.medicine_js')
@endsection
