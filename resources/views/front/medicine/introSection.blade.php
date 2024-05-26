<section class="about-area about-4 pt-100">
    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="image mb-40 img-left">
                    @if ($bs->intro_main_image)
                        <img class="lazyload blur-up" src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}"
                            data-src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}" alt="Image">
                    @endif
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="content-title mb-40">
                    <h2 class="title mb-20">
                        {{ convertUtf8($bs->intro_title) }}
                    </h2>
                    <div class="content-text">
                        <p>
                            {{ convertUtf8($bs->intro_text) }}
                        </p>
                    </div>
                    @if ($intro_feature_items->count() > 0)
                        <div class="info-list mt-40">
                            @foreach ($intro_feature_items as $item)
                           
                                <div class="card radius-0 mb-15">
                                        <div class="row">
                                            @if ($item->icon && $item->intro_section_rating_point)
                                            <div class="col-md-4 col-sm-5">
                                                <div class="card-icon mb-15">
                                                    <i class="{{ $item->icon }}"></i>
                                                    <span class="h4 font-medium mb-0 color-white"><span
                                                            class="counter">{{ $item->intro_section_rating_point }}</span>{{ $item->intro_section_rating_symbol }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-8 col-sm-7">
                                                <div class="card-content mb-15">
                                                    <h4 class="card-title mb-2">{{ $item->title }}</h4>
                                                    <p class="card-text">
                                                        {{ $item->text }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                               
                                   
                            @endforeach

                        </div>
                    @endif
                    <div class="d-flex align-items-sm-center flex-column flex-sm-row gap-25">
                        @if ($bs->intro_section_author_image || $bs->intro_section_author_name)
                            <div class="author d-flex align-items-center gap-15 mt-10">
                                @if ($bs->intro_section_author_image)
                                    <div class="author-img">
                                        <div class="lazy-container ratio ratio-1-1">
                                            <img class="lazyload"
                                                src="{{ asset('assets/front/img/' . $bs->intro_section_author_image) }}"
                                                data-src="{{ asset('assets/front/img/' . $bs->intro_section_author_image) }}"
                                                alt="Person Image">
                                        </div>
                                    </div>
                                @endif
                                <div class="content">
                                    <h6 class="name mb-0">
                                        <a target="_self" title="{{ $bs->intro_section_author_name }}">
                                            {{ $bs->intro_section_author_name }} </a>
                                    </h6>
                                    <span class="designation font-sm">
                                        {{ $bs->intro_section_author_designation }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ($bs->intro_video_link)
                            <div class="vr d-none d-sm-block"></div>
                            <a href="{{ $bs->intro_video_link }}" class="btn-icon-text gap-15 youtube-popup"
                                target="_self" title="Show Video">
                                <i class="fas fa-play"></i>
                                <div>
                                    <span class="h6 mb-0">{{ $bs->intro_section_video_button_title }}</span>
                                    <span>{{ $bs->intro_section_video_button_text }}</span>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
