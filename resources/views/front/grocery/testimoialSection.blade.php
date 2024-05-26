<section class="testimonial-area testimonial-1 pb-60">
    <div class="container">
        <div class="section-title row mb-50 justify-content-between align-items-center" data-aos="fade-up">
            <div class="col-lg-6">
                <h2 class="title">
                    {{ convertUtf8($bs->testimonial_title) }}
                </h2>
            </div>
            <div class="col-lg-4">
                <p class="font-lg">
                    {{ convertUtf8($bs->testimonial_section_text) }}
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="swiper overflow-hidden" id="testimonial-slider-5" data-aos="fade-up">
                    <div class="swiper-wrapper">

                        @forelse ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="slider-item radius-md shadow-md border">
                                    <div class="client gap-20 flex-wrap">
                                        <div class="client-info d-flex align-items-center">
                                            <div class="client-img">
                                                <div class="lazy-container rounded-pill ratio ratio-1-1">
                                                    <img class="lazyload" src="{{ asset('assets/front/img/testimonials/' . $testimonial->image) }}"
                                                        data-src="{{ asset('assets/front/img/testimonials/' . $testimonial->image) }}" alt="Person Image">
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h6 class="name mb-0"><a target="_self"
                                                        title="Link">{{ convertUtf8($testimonial->name) }}</a></h6>
                                                <span class="designation font-sm">{{ convertUtf8($testimonial->rank) }}</span>
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
                                                <div class="rating-icon" style="width: {{ $rating }}% !important"></div>
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
                    <div class="swiper-pagination position-static mt-30 mb-40" id="testimonial-slider-5-pagination">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fluid-right">
                    <div class="image mb-40" data-aos="fade-left">
                        <img class="lazyload blur-up" src="assets/images/placeholder.png"
                            data-src="{{ asset('assets/front/img/' . $be->testimonial_side_img) }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
