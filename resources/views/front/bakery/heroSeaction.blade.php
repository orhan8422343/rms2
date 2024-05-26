<section class="hero-banner hero-banner-1 parallax pb-100">
    <div class="overlay opacity-80"></div>
    <div class="container-fluid">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6">
                <div class="fluid-left">
                    <div class="banner-content mb-40">
                        @if($be->hero_section_bold_text)
                        <h1 class="title mb-30" data-aos="fade-up" data-aos-delay="100"
                            style="color: #{{ $be->hero_section_bold_text_color }};font-size:{{ $be->hero_section_bold_text_font_size }}px;">
                            {{ convertUtf8($be->hero_section_bold_text) }}</h1>
                        @endif

                        @if($be->hero_section_text)
                        <p class="text" data-aos="fade-up" data-aos-delay="100"
                            style="color: #{{ $be->hero_section_text_color }}; font-size: {{ $be->hero_section_text_font_size }}px;">
                            {{ convertUtf8($be->hero_section_text) }}
                        </p>
                        @endif
                        <div class="d-flex align-items-center gap-25 flex-wrap mt-40" data-aos="fade-up"
                            data-aos-delay="200">
                            @if ($be->hero_section_button_url)
                                <a href="{{ $be->hero_section_button_url }}" class="btn btn-lg btn-primary rounded-pill"
                                    title="{{ convertUtf8($be->hero_section_button_text) }}" target="_self"
                                    style="background: #{{ $be->hero_section_button_color }};font-size: {{ $be->hero_section_button_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_color }}">{{ convertUtf8($be->hero_section_button_text) }}</a>
                            @endif

                            @if ($be->hero_section_author_image || $be->hero_section_author_name)
                                <div class="author d-flex align-items-center gap-15">
                                    @if ($be->hero_section_author_image)
                                        <div class="author-img">
                                            <div class="lazy-container rounded-pill ratio ratio-1-1">
                                                <img class="lazyload"
                                                    src="{{ asset('assets/front/img/' . $be->hero_section_author_image) }}"
                                                    data-src="{{ asset('assets/front/img/' . $be->hero_section_author_image) }}"
                                                    alt="Person Image">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($be->hero_section_author_name)
                                        <div class="content">
                                            <h6 class="name mb-0 font-sm"><a  target="_self"
                                                    title="">{{ convertUtf8($be->hero_section_author_name) }}</a>
                                            </h6>
                                            <span
                                                class="designation font-xsm">{{ convertUtf8($be->hero_section_author_designation) }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @if ($be->hero_side_img)
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="banner-image mb-40 parallax-img" data-speed="0.1" data-revert="true">
                        <img class="lazyload blur-up" src="{{ asset('assets/front/img/' . $be->hero_side_img) }}"
                            data-src="{{ asset('assets/front/img/' . $be->hero_side_img) }}" alt="Banner Image">
                    </div>
                </div>
            @endif

        </div>
    </div>
    @if ($be->hero_bg)
        <div class="bg-img" data-bg-image="{{ asset('assets/front/img/' . $be->hero_bg) }}"></div>
    @endif
</section>
