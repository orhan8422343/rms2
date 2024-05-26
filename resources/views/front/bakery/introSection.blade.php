<section class="about-area about-1 pt-100 pb-60 bg-dark">
    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="image mb-40">
                    @if ($bs->intro_main_image)
                        <img class="lazyload blur-up" src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}"
                            data-src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}" alt="Image">
                    @endif

                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="content-title mb-10 ps-xl-2">
                    <h2 class="title mb-20">
                        {{ convertUtf8($bs->intro_title) }}

                    </h2>
                    <div class="content-text">
                        <p>
                            {{ convertUtf8($bs->intro_text) }}
                        </p>
                    </div>
                    <div class="info-list mt-40">
                        <div class="row gx-xl-5">

                            @foreach ($intro_feature_items as $item)
                                <div class="col-md-6 item mb-30">
                                    <div class="card">
                                        <div class="card-icon rounded-pill">
                                            @if ($item->icon)
                                                <i class="{{ $item->icon }}"></i>
                                            @endif
                                        </div>
                                        <div class="card-content">
                                            <h6 class="card-title mb-2">{{ convertUtf8($item->title) }}</h6>
                                            <p class="card-text">{{ convertUtf8($item->text) }}</p>
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
