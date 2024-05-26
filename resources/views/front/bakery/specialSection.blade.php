<section class="product-area product-lg-1 pt-100 pb-70 bg-img"
    data-bg-image="{{ asset('assets/front/img/' . $be->special_section_bg_image) }}">
    <div class="overlay opacity-85"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-50" data-aos="fade-up">
                    <h2 class="title">{{ convertUtf8($be->special_section_title) }}</h2>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up">
                <div class="row">
                    @forelse ($special_product as $sproduct)

                    @php
                    $images=['pro-1.png','pro-2.png','pro-3.png','pro-4.png','pro-5.png','pro-6.png','pro-7.png','pro-8.png','pro-9.png','pro-10.png','pro-11.png'];        
                    $sproduct->feature_image = $images[array_rand($images)];
                    @endphp



                        <div class="col-md-6 col-lg-4">
                            <div class="product text-center p-30 radius-md mb-30">
                                <figure class="product-img mb-10 mx-auto">
                                    <a href="{{ route('front.product.details', [$sproduct->slug, $sproduct->id]) }}"
                                        target="_self" title="{{ convertUtf8($sproduct->title) }}"
                                        class="lazy-container ratio ratio-1-1 bg-none">
                                        <img class="lazyload"
                                            src="{{ asset('assets/front/img/product/featured/' . $sproduct->feature_image) }}"
                                            data-src="{{ asset('assets/front/img/product/featured/' . $sproduct->feature_image) }}"
                                            alt="Image">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title lc-1 mb-10"><a
                                            href="{{ route('front.product.details', [$sproduct->slug, $sproduct->id]) }}"
                                            target="_self"
                                            title="{{ convertUtf8($sproduct->title) }}">{{ convertUtf8($sproduct->title) }}</a>
                                    </h3>
                                    <div class="ratings justify-content-center mb-10">
                                        <div class="rate">
                                             <div class="rating-icon" style="width: {{$sproduct->rating? $sproduct->rating * 20 : 0}}% !important"></div>
                                        </div>
                                        <span class="ratings-total">({{$sproduct->rating}})</span>
                                    </div>
                                    <div class="product-price mb-15">
                                        <span class="h4 new-price" dir="ltr">
                                            {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($sproduct->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                        @if (!empty(convertUtf8($sproduct->previous_price)))
                                            <span
                                                class="prev-price" dir="ltr">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($sproduct->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                        @endif
                                    </div>
                                    <p class="product-text mb-25">
                                        {{ convertUtf8(strlen($sproduct->summary)) > 70 ? convertUtf8(substr($sproduct->summary, 0, 70)) . '...' : convertUtf8($sproduct->summary) }}
                                    </p>
                                    <a data-product="{{ $sproduct }}"
                                        data-href="{{ route('add.cart', $sproduct->id) }}"
                                        class="cart-link btn btn-lg btn-outline rounded-pill"
                                        title="{{ __('Add to Cart') }}"
                                        target="_self">{{ __('Add to Cart') }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                    <h2>{{__('No Special Food')}}</h2>
                    @endforelse





                </div>
            </div>
        </div>
    </div>
</section>
