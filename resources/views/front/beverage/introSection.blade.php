<section class="about-area about-3 pt-100 pb-60 parallax">
    <!-- Spacer -->
    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6" data-aos="fade-up">
                @if ($bs->intro_main_image)
                <div class="image mb-40 parallax-img img-left" data-speed="0.1" data-revert="true">
                    <img class="lazyload blur-up" src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}" data-src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}" alt="Image">
                </div>
                @endif
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="content-title mb-10 ps-xl-2">
                    <h2 class="title mb-30">
                        {{ convertUtf8($bs->intro_title) }}
                    </h2>
                    <div class="content-text">
                        <p>
                            {{ convertUtf8($bs->intro_text) }}
                        </p>

                    </div>
                    <div class="info-list mt-30">
                        <div class="row">
                            @foreach ($intro_feature_items as $item)
                            <div class="col-sm-4 item mb-30">
                                <div class="card">
                                    <div class="card-content">
                                        <span class="h3 font-medium mb-2"><span class="counter">{{ convertUtf8($item->intro_section_rating_point) }}</span>{{ $item->intro_section_rating_symbol }}</span>
                                        <p class="card-text font-lg lh-1">{{ convertUtf8($item->title) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>