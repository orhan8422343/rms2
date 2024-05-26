<section class="testimonial-area testimonial-1 ptb-100 bg-img"
    data-bg-image="{{ asset('assets/front/img/' . $be->testimonial_bg_img) }}">
    <!-- Spacer -->
    <div class="spacer pt-120"></div>

    <div class="container">
        <div class="section-title row mb-50 justify-content-between align-items-center" data-aos="fade-up">
            <div class="col-lg-5">
                <h2 class="title color-white mb-0">
                    {{ convertUtf8($bs->testimonial_title) }}

                </h2>
            </div>
            <div class="col-lg-5">
                <p class="font-lg color-light">
                    {{ convertUtf8($bs->testimonial_section_text) }}
                </p>
            </div>
        </div>
    </div>
    <!---All testimonial Section-->
    <div class="container-fluid px-sm-0">
        <div class="row">
            <div class="col-12">
                <div class="fluid-left">
                    <div class="swiper overflow-hidden" id="testimonial-slider-2" data-aos="fade-up">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide p-0">
                                    <div class="slider-item radius-md bg-dark">
                                        <div class="client gap-20 flex-wrap">
                                            <div class="client-info d-flex align-items-center">
                                                <div class="client-img">
                                                    <div class="lazy-container rounded-pill ratio ratio-1-1">
                                                        <img class="lazyload"
                                                            src="{{ asset('assets/front/img/testimonials/' . $testimonial->image) }}"
                                                            data-src="{{ asset('assets/front/img/testimonials/' . $testimonial->image) }}"
                                                            alt="Person Image">
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h6 class="name mb-0 color-white">
                                                        <a target="_self"
                                                            title="{{ convertUtf8($testimonial->name) }}">{{ convertUtf8($testimonial->name) }}</a>
                                                    </h6>
                                                    <span
                                                        class="designation font-sm">{{ convertUtf8($testimonial->rank) }}</span>
                                                </div>
                                            </div>
                                            <div class="ratings size-md flex-column align-items-start">
                                                @php
                                                    $rating = 0;
                                                    if ($testimonial->rating == 0) {
                                                        $rating = 0;
                                                    } elseif ($testimonial->rating == 1) {
                                                        $rating = 20;
                                                    } elseif ($testimonial->rating == 2) {
                                                        $rating = 40;
                                                    } elseif ($testimonial->rating == 3) {
                                                        $rating = 60;
                                                    } elseif ($testimonial->rating == 4) {
                                                        $rating = 80;
                                                    } elseif ($testimonial->rating == 5) {
                                                        $rating = 100;
                                                    }
                                                @endphp

                                                <div class="rate">
                                                    <div class="rating-icon"
                                                        style="width: {{ $rating }}% !important"></div>
                                                </div>
                                                <div class="ratings-total mt-2">
                                                    {{$testimonial->rating}} {{ $testimonial->rating == 1 ? __('star') : __('stars')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <span class="icon"><i class="fal fa-quote-right"></i></span>
                                            <p class="text font-lg mb-0">
                                                {{ convertUtf8($testimonial->comment) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination position-static mt-30" id="testimonial-slider-2-pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Spacer -->
    <div class="spacer pb-120"></div>
    <!-- Bg shape -->
    @if($be->testimonial_section_top_shape_image)
    <div class="bg-shape">
        <img class="lazyload" data-src="{{ asset('assets/front/img/' . $be->testimonial_section_top_shape_image) }}"
            alt="Bg Shape">
    </div>
    @endif
    @if($be->testimonial_section_bottom_shape_image)
    <div class="bg-shape h-auto">
        <img class="lazyload" data-src="{{ asset('assets/front/img/' . $be->testimonial_section_bottom_shape_image) }}"
            alt="Bg Shape">
    </div>
    @endif
</section>
