<section class="category-area category-4 pt-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-50" data-aos="fade-up">
                    <h2 class="title mb-0">{{convertUtf8($bs->feature_title)}}</h2>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up">
                <div class="swiper category-slider" id="category-slider-3" data-slides-per-view="5" data-swiper-loop="false">
                    <div class="swiper-wrapper">
                        @foreach ($features as $feature)
                        <div class="swiper-slide">
                            <div class="card text-center p-15">
                                <div class="card-image mb-10 mx-auto">
                                    <a  target="_self" title="{{ convertUtf8($feature->title) }}" class="lazy-container ratio ratio-1-1 bg-none">
                                        <img class="lazyload" src="{{ asset('assets/front/img/features/' . $feature->image) }}" data-src="{{ asset('assets/front/img/features/' . $feature->image) }}" alt="Image">
                                    </a>
                                </div>
                                <h4 class="card-title lc-1 mb-0"><a  target="_self" title="{{ convertUtf8($feature->title) }}">{{ convertUtf8($feature->title) }}</a></h4>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination position-static mt-40" id="category-slider-3-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>