<section class="product-area product-1 ptb-100 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-30" data-aos="fade-up">
                    <h2 class="title mb-30">{{ convertUtf8($be->menu_section_title) }}</h2>
                    <div class="tabs-navigation tabs-navigation-2">
                        <ul class="nav nav-tabs border-bottom" data-hover="fancyHover">
                            @foreach ($categories as $keys => $category)
                                <li class="nav-item {{ $keys == 0 ? 'active' : '' }}">
                                    <button
                                        class="nav-link hover-effect {{ $keys == 0 ? 'active' : '' }} btn-lg rounded-pill"
                                        data-bs-toggle="tab" data-bs-target="#{{ $category->slug }}"
                                        type="button">{{ convertUtf8($category->name) }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content" data-aos="fade-up">

                    @foreach ($categories as $keys => $category)
                        <div class="tab-pane slide {{ $keys == 0 ? 'show active' : '' }}" id="{{ $category->slug }}">
                            <div class="tabs-navigation text-center mb-50">
                                <ul class="nav nav-tabs" data-hover="fancyHover">


                                    @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subkeys => $subcat)
                                        <li class="nav-item  {{ $subkeys == 0 ? 'active' : '' }} ">
                                            <button
                                                class="nav-link hover-effect btn-md rounded-pill {{ $subkeys == 0 ? 'active' : '' }}"
                                                data-bs-toggle="tab" data-bs-target="#sub_{{ $subcat->id }}"
                                                type="button">{{ convertUtf8($subcat->name) }}</button>
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
                                                $images=['pro-1.png','pro-2.png','pro-3.png','pro-4.png','pro-5.png','pro-6.png','pro-7.png','pro-8.png','pro-9.png','pro-10.png','pro-11.png'];        
                                                $product->feature_image = $images[array_rand($images)];
                                                @endphp


                                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                                        <div class="product text-center p-40 rounded-circle mb-25">
                                                            <figure class="product-img mb-10 mx-auto">
                                                                <a href="{{ route('front.product.details', [$product->slug, $product->id]) }}"
                                                                    target="_self"
                                                                    title="{{ convertUtf8($product->title) }}"
                                                                    class="lazy-container ratio ratio-1-1 bg-none">
                                                                    <img class="lazyload"
                                                                        src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                        data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                        alt="Image">
                                                                </a>
                                                                <div class="hover-show">
                                                                    <a data-product="{{ $product }}"
                                                                        data-href="{{ route('add.cart', $product->id) }}"
                                                                        class="cart-link btn btn-md btn-primary rounded-pill"
                                                                        title="Add to Cart" target="_self">Add to
                                                                        Cart</a>
                                                                </div>
                                                            </figure>
                                                            <div class="product-details">
                                                                <h6 class="product-title lc-1 mb-1"><a
                                                                        href="{{ route('front.product.details', [$product->slug, $product->id]) }}"
                                                                        target="_self"
                                                                        title="{{ convertUtf8($product->title) }}">{{ convertUtf8($product->title) }}</a>
                                                                </h6>
                                                                <div class="ratings justify-content-center mb-10">
                                                                    <div class="rate">
                                                                         <div class="rating-icon" style="width:{{$product->rating ? $product->rating * 20 : 0}}% !important"></div>
                                                                    </div>
                                                                    <span class="ratings-total">({{$product->rating}})</span>
                                                                </div>
                                                                <div class="product-price">
                                                                    <span
                                                                        class="h6 font-sm new-price color-primary" dir="ltr">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}
                                                                        {{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                                                    @if ($product->previous_price)
                                                                        <span
                                                                            class="prev-price font-sm" dir="ltr">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
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
                            @if ($category->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                <div class="cta-btn text-center mt-15">
                                    <a href="{{ route('front.items', ['category_id' => $category->id]) }}"
                                        class="btn btn-lg btn-primary rounded-pill" title="{{ __('View All Items') }}"
                                        target="_self">{{ __('View All Items') }}</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
