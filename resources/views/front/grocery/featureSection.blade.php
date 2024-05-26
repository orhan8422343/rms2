<section class="category-area category-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-50" data-aos="fade-up">
                    <h2 class="title mb-0">{{ convertUtf8($bs->feature_title) }}</h2>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up">
                <div class="swiper category-slider" id="category-slider-5" data-slides-per-view="6"
                    data-swiper-loop="false">
                    <div class="swiper-wrapper">
                        @forelse ($features as $feature)
                        <div class="swiper-slide">
                            <div class="card text-center">
                                <div class="card-image mb-10 mx-auto">
                                    <a  target="_self" title=""
                                        class="lazy-container ratio ratio-2-3 bg-none">
                                        <img class="lazyload" src="{{ asset('assets/front/img/features/' . $feature->image) }}"
                                            data-src="{{ asset('assets/front/img/features/' . $feature->image) }}" alt="Image">
                                    </a>
                                </div>
                                <h4 class="card-title lc-1 mb-1"><a  target="_self"
                                        title="{{ convertUtf8($feature->title) }}">{{ convertUtf8($feature->title) }}</a></h4>
                                
                            </div>
                        </div>
                        @empty
                        <h2> {{ __('No Features')}} </h2>
                        @endforelse
                    </div>
                    <div class="swiper-pagination position-static mt-40" id="category-slider-5-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>