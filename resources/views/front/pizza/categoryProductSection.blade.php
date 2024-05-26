    <!-- Product-area start -->
    <section class="product-area product-2 pt-100 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title title-center mb-30" data-aos="fade-up">
                        <h2 class="title mb-30">{{ convertUtf8($be->menu_section_title) }}</h2>
                        <div class="tabs-navigation tabs-navigation-2">
                            <ul class="nav nav-tabs border-bottom" data-hover="fancyHover">

                                @foreach ($categories as $keys => $category)
                                    <li class="nav-item {{ $keys == 0 ? 'active' : '' }}">
                                        <button class="nav-link hover-effect {{ $keys == 0 ? 'active' : '' }} btn-lg"
                                            data-bs-toggle="tab" data-bs-target="#{{ $category->slug }}"
                                            type="button">{{ convertUtf8($category->name) }}
                                        </button>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content" data-aos="fade-up">
                        @foreach ($categories as $keys => $category)
                            <div class="tab-pane slide {{ $keys == 0 ? 'show active' : '' }}"
                                id="{{ $category->slug }}">
                                <div class="tabs-navigation text-center mb-50">
                                    <ul class="nav nav-tabs" data-hover="fancyHover">
                                        @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subkeys => $subcat)
                                            <li class="nav-item {{ $subkeys == 0 ? 'active' : '' }}">
                                                <button
                                                    class="nav-link hover-effect {{ $subkeys == 0 ? 'active' : '' }} btn-md rounded-pill"
                                                    data-bs-toggle="tab" data-bs-target="#sub_{{ $subcat->id }}"
                                                    type="button">{{ convertUtf8($subcat->name) }}
                                                </button>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="tab-content">
                                    @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subkeys => $subcat)
                                        <div class="tab-pane slide {{ $subkeys == 0 ? 'show active' : '' }}"
                                            id="sub_{{ $subcat->id }}">
                                            <div class="row">
                                                @if ($subcat->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                                    @foreach ($subcat->products()->where('is_feature', 1)->where('status', 1)->get() as $product)

                                                    @php
                                                    $images=['pro-12.png','pro-13.png','pro-14.png','pro-15.png','pro-16.png','pro-17.png','pro-18.png','pro-19.png','pro-20.png','pro-21.png'];        
                                                    $product->feature_image = $images[array_rand($images)];
                                                    @endphp


                                                    <div class="col-md-6 col-lg-4 col-xl-3 item">
                                                            <div class="product radius-md text-center p-30 mb-25">
                                                                <figure class="product-img mb-20 mx-auto">
                                                                    <a href="{{ route('front.product.details', [$product->slug, $product->id]) }}"
                                                                        target="_self" title="{{ convertUtf8($product->title) }}"
                                                                        class="lazy-container ratio ratio-1-1 bg-none">
                                                                        <img class="lazyload"
                                                                            src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                            data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                            alt="Image">
                                                                    </a>
                                                                    <div class="hover-show">
                                                                        <a href="{{ route('front.product.details', [$product->slug, $product->id]) }}"
                                                                            class="cart-link btn btn-md btn-outline rounded-pill"
                                                                            title="{{ __('Add to Cart') }}"
                                                                            target="_self"
                                                                            data-product="{{ $product }}"
                                                                            data-href="{{ route('add.cart', $product->id) }}">{{ __('Add to Cart') }}</a>
                                                                    </div>
                                                                </figure>
                                                                <div class="product-details">
                                                                    <h4 class="product-title lc-1 mb-1"><a
                                                                            href="{{ route('front.product.details', [$product->slug, $product->id]) }}"
                                                                            target="_self"
                                                                            title="{{ convertUtf8($product->title) }}">{{ convertUtf8($product->title) }}</a>
                                                                    </h4>
                                                                    <div class="ratings justify-content-center mb-10">
                                                                        <div class="rate">
                                                                             <div class="rating-icon" style="width:{{$product->rating ? $product->rating * 20 : 0}}% !important"></div>
                                                                        </div>
                                                                        <span class="ratings-total">({{$product->rating}})</span>
                                                                    </div>
                                                                    <div class="product-price">
                                                                        <span
                                                                            class="h6 font-lg new-price color-primary" dir="ltr">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                                                        @if ($product->previous_price)
                                                                            <span class="prev-price font-sm" dir="ltr">
                                                                                {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cta-btn text-center mt-15 mb-25">
                                    <a href="{{ route('front.items', ['category_id' => $category->id]) }}"
                                        class="btn btn-lg btn-primary rounded-pill" title="{{ __('View All Items') }}"
                                        target="_self">{{ __('View All Items') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product-area end -->
