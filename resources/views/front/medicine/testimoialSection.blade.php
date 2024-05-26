<section class="testimonial-area testimonial-1 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-50" data-aos="fade-up">
                    <h2 class="title mb-0">
                        {{ convertUtf8($bs->testimonial_title) }}
                    </h2>
                </div>
            </div>
            <div class="col-12">
                <div class="swiper overflow-hidden" id="testimonial-slider-4" data-aos="fade-up">
                    <div class="swiper-wrapper">
                        @forelse($testimonials as $testimonial)
                            <div class="swiper-slide p-0">
                                <div class="slider-item border radius-md">
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
                                                <h6 class="name mb-0"><a target="_self"
                                                        title="{{ convertUtf8($testimonial->name) }}">{{ convertUtf8($testimonial->name) }}</a>
                                                </h6>
                                                <span
                                                    class="designation font-sm">{{ convertUtf8($testimonial->rank) }}</span>
                                            </div>
                                        </div>
                                        <div class="ratings size-md flex-column align-items-start align-items-start">
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
                                                <div class="rating-icon" style="width: {{ $rating }}% !important">
                                                </div>
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
                        @empty
                            {{ __('No Testimonial') }}
                        @endforelse

                    </div>
                    <div class="swiper-pagination position-static mt-30" id="testimonial-slider-4-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
