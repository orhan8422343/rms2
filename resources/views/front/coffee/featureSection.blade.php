<section class="category-area category-3 ptb-100 bg-primary">
    <!-- Spacer -->
    <div class="spacer pt-40"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title title-center mb-50" data-aos="fade-up">
                    <h2 class="title mb-0 color-white">{{ convertUtf8($bs->feature_title) }}</h2>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up">
                <div class="row">
                    @forelse ($features as $feature)
                    <div class="col-xl-2 col-lg-3 col-6">
                        <div class="card text-center bg-dark p-20 mb-25">
                            <div class="card-icon mb-20">
                                <img class="lazyload blur-up" src="{{ asset('assets/front/img/features/' . $feature->image) }}" data-src="{{ asset('assets/front/img/features/' . $feature->image) }}" alt="Image">
                            </div>

                            <h6 class="card-title color-white lc-1 mb-0">
                                <a target="_self" title="{{ convertUtf8($feature->title) }}">{{ convertUtf8($feature->title) }}</a>
                            </h6>
                        </div>
                    </div>
                    @empty
                    <h2> {{ __('No Features')}} </h2>

                    @endforelse

                    
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Spacer -->
    <div class="spacer pb-20"></div>
    <!-- Bg shape -->
    @if($bs->features_section_top_shape_image)
    <div class="bg-shape">
        <img class="lazyload" data-src="{{ asset('assets/front/img/'.$bs->features_section_top_shape_image) }}" alt="Bg Shape">
    </div>
    @endif
    @if($bs->features_section_bottom_shape_image)
    <div class="bg-shape h-auto">
        <img class="lazyload" data-src="{{ asset('assets/front/img/'.$bs->features_section_bottom_shape_image) }}" alt="Bg Shape">
    </div>
    @endif
</section>