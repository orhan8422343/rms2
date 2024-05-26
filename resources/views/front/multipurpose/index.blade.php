@extends('front.layout')

@section('content')
    <!--====== HERO SECTION PART START ======-->
    @if ($bs->home_version == 'static')
        @include('front.multipurpose.hero.static')
    @elseif ($bs->home_version == 'slider')
        @include('front.multipurpose.hero.slider')
    @elseif ($bs->home_version == 'video')
        @include('front.multipurpose.hero.video')
    @elseif ($bs->home_version == 'water')
        @include('front.multipurpose.hero.water')
    @elseif ($bs->home_version == 'particles')
        @include('front.multipurpose.hero.particles')
    @elseif ($bs->home_version == 'parallax')
        @include('front.multipurpose.hero.parallax')
    @endif
    <!--====== HERO SECTION PART END ======-->






    <!--====== FOOD MENU PART START ======-->
    @if ($bs->menu_section == 1)
        @if ($be->menu_version == 1)
            <section class="food-menu-area food-menu-2-area food-menu-3-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span>{{ convertUtf8($be->menu_section_title) }}
                                    <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}"
                                        alt=""></span>
                                <h3 class="title">{{ convertUtf8($be->menu_section_subtitle) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    @foreach ($categories as $keys => $category)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $keys == 0 ? 'active' : '' }}"
                                                id="{{ $category->slug }}-tab" data-toggle="pill"
                                                href="#{{ $category->slug }}" role="tab"
                                                aria-controls="{{ $category->slug }}" aria-selected="true">
                                                @if (!empty($category->image))
                                                    <img class="lazy wow fadeIn"
                                                        data-src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                                        data-wow-delay=".5s" alt="menu">
                                                @endif
                                                <input type="hidden" value="{{ $category->id }}" class="id">
                                                <p @if (empty($category->image)) style="padding-top: 0px;" @endif>
                                                    {{ convertUtf8($category->name) }}
                                                    ({{ $category->products()->where('is_feature', 1)->count() }})
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($categories as $key => $category)
                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                        id="{{ $category->slug }}" role="tabpanel"
                                        aria-labelledby="{{ $category->slug }}-tab">

                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*" @if ($category->subcategories()->where('is_feature', 1)->count() == 0) style="display:none;" @endif>{{__('All')}}</button>
                                            @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subcat)
                                                <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                            @endforeach
                                        </div>

                                        <div class="row justify-content-center">

                                            {{-- Loader --}}
                                            <div class="food-items-loader">
                                                <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
                                            </div>
                                            {{-- Loader --}}

                                            @if ($category->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                                @foreach ($category->products()->where('is_feature', 1)->where('status', 1)->get() as $product)
                                                    <div class="col-lg-6">
                                                        <div class="food-menu-items">

                                                            <div class="single-menu-item mt-30 sub{{$product->subcategory_id}}">
                                                                <div class="item-details">
                                                                    <div class="menu-thumb">
                                                                        <img class="lazy wow fadeIn"
                                                                            data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                            alt="menu" data-wow-delay=".5s">
                                                                        <div class="thumb-overlay">
                                                                            <a
                                                                                href="{{ route('front.product.details', [$product->slug, $product->id]) }}"><i
                                                                                    class="flaticon-add"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="menu-content ml-30">
                                                                        <a class="title"
                                                                            href="{{ route('front.product.details', [$product->slug, $product->id]) }}">{{ convertUtf8($product->title) }}</a>
                                                                        <p>{{ convertUtf8(strlen($product->summary)) > 70? convertUtf8(substr($product->summary, 0, 70)) . '...': convertUtf8($product->summary) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="menu-price-btn">
                                                                    <a class="cart-link d-md-none d-block btn mobile"
                                                                    data-product="{{ $product }}"
                                                                    data-href="{{ route('add.cart', $product->id) }}">+</a>
                                                                    <a class="cart-link d-none d-md-block"
                                                                        data-product="{{ $product }}"
                                                                        data-href="{{ route('add.cart', $product->id) }}">{{ __('Add to Cart') }}</a>

                                                                    <span>{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                                                    </span>
                                                                    @if ($product->previous_price)
                                                                        <del>
                                                                            {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</del>
                                                                    @endif
                                                                </div>
                                                                @if ($product->is_special == 1)
                                                                    <div class="flag flag-2">
                                                                        <span>{{ __('Special') }}</span>
                                                                    </div>
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12">
                                                    <div class="menu-more-btn text-center mt-40">
                                                        <a
                                                            href="{{ route('front.items', ['category_id' => $category->id]) }}">{{ __('View All Items') }}</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">{{ __('Product Not Found') }}</h4>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            @if (!empty($be->menu_section_img))
                <style>
                    .food-menu-area .food-menu-items.menu-2::before {
                        background-image: url("{{ asset('assets/front/img/' . $be->menu_section_img) }}");
                    }

                </style>
            @endif
            <section class="food-menu-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span>{{ convertUtf8($be->menu_section_title) }} <img
                                        src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                                <h3 class="title">{{ convertUtf8($be->menu_section_subtitle) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    @foreach ($categories as $keys => $category)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $keys == 0 ? 'active' : '' }}"
                                                id="{{ convertUtf8($category->slug) }}-tab" data-toggle="pill"
                                                href="#{{ convertUtf8($category->slug) }}" role="tab"
                                                aria-controls="{{ convertUtf8($category->slug) }}" aria-selected="true">
                                                @if (!empty($category->image))
                                                    <img class="lazy wow fadeIn"
                                                        src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                                        data-wow-delay=".5s" alt="menu">
                                                @endif
                                                <p @if (empty($category->image)) style="padding-top: 0px;" @endif>
                                                    {{ convertUtf8($category->name) }}
                                                    ({{ $category->products()->where('is_feature', 1)->count() }})
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($categories as $key => $category)
                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                        id="{{ convertUtf8($category->slug) }}" role="tabpanel"
                                        aria-labelledby="{{ convertUtf8($category->slug) }}-tab">

                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*" @if ($category->subcategories()->where('is_feature', 1)->count() == 0) style="display:none;" @endif>{{__('All')}}</button>
                                            @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subcat)
                                                <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                            @endforeach
                                        </div>

                                        <div class="food-menu-items menu-2">

                                            {{-- Loader --}}
                                            <div class="food-items-loader">
                                                <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
                                            </div>
                                            {{-- Loader --}}

                                            @if ($category->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                                @foreach ($category->products()->where('is_feature', 1)->where('status', 1)->get()  as $product)
                                                    <div class="single-menu-item mt-30 sub{{$product->subcategory_id}}">
                                                        <div class="menu-thumb">
                                                            <img class="lazy wow fadeIn"
                                                                data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                data-wow-delay=".5s" alt="menu">
                                                            <div class="thumb-overlay">
                                                                <a
                                                                    href="{{ route('front.product.details', [$product->slug, $product->id]) }}"><i
                                                                        class="flaticon-add"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="menu-content ml-30">
                                                            <a class="title"
                                                                href="{{ route('front.product.details', [$product->slug, $product->id]) }}">{{ convertUtf8($product->title) }}</a>
                                                            <p>{{ convertUtf8(strlen($product->summary)) > 180? convertUtf8(substr($product->summary, 0, 180)) . '...': convertUtf8($product->summary) }}
                                                            </p>
                                                        </div>
                                                        <div class="menu-price-btn menu-2">
                                                            <span>{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                                            </span>
                                                            @if ($product->previous_price)
                                                                <del>
                                                                    {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</del>
                                                            @endif
                                                            <a class="cart-link d-md-none d-block btn mobile"
                                                            data-product="{{ $product }}"
                                                            data-href="{{ route('add.cart', $product->id) }}">+</a>
                                                            <a class="cart-link d-none d-md-block"
                                                                data-product="{{ $product }}"
                                                                data-href="{{ route('add.cart', $product->id) }}">{{ __('Add to Cart') }}</a>
                                                        </div>
                                                        @if ($product->is_special == 1)
                                                            <div class="flag flag-2"><span>{{ __('Special') }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">{{ __('Product Not Found') }}</h4>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="menu-more-btn text-center mt-75">
                                                    <a
                                                        href="{{ route('front.items', ['category_id' => $category->id]) }}">{{ __('View All Items') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        @endif
    @endif
    <!--====== FOOD MENU PART ENDS ======-->






    <!--====== BLOG PART START ======-->
    @if ($bs->news_section == 1)
        <section class="blog-area pb-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="section-title text-center">
                            <span>{{ convertUtf8($bs->blog_section_title) }} <img
                                    src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">{{ convertUtf8($bs->blog_section_subtitle) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6 col-md-8">
                            <div class="single-blog mt-30">
                                <div class="blog-thumb">
                                    <img class="lazy wow fadeIn"
                                        data-src="{{ asset('assets/front/img/blogs/' . $blog->main_image) }}" alt=""
                                        data-wow-delay=".5s" data-wow-duration="1s">
                                </div>
                                <div class="blog-content">
                                    <a href="{{ route('front.blogdetails', [$blog->slug, $blog->id]) }}">
                                        <h3 class="title">{{ convertUtf8($blog->title) }}</h3>
                                    </a>
                                    <p>{{ convertUtf8(strlen(strip_tags($blog->content)) > 100)? convertUtf8(substr(strip_tags($blog->content), 0, 100)) . '...': convertUtf8(strip_tags($blog->content)) }}
                                    </p>

                                    <div
                                        class="blog-comments d-block d-sm-flex justify-content-between align-items-center">
                                        <a
                                            href="{{ route('front.blogdetails', [$blog->slug, $blog->id]) }}">{{ __('Read More') }}</a>
                                        <ul>
                                            <li><i class="far fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                                                <span>|</span> {{ __('Admin') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section>
    @endif
    <!--====== BLOG PART ENDS ======-->




    {{-- Variation Modal Starts --}}
    {{-- @include('front.partials.variation-modal') --}}
    {{-- Variation Modal Ends --}}
@endsection
