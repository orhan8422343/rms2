<section class="hero-banner hero-banner-6 parallax">
    <div class="container-fluid">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6">
                <div class="fluid-left">
                    <div class="banner-content mb-40">
                        @if($be->hero_section_bold_text)
                        <h1 class="title color-dark mb-30" data-aos="fade-up" data-aos-delay="100"
                            style="color: #{{ $be->hero_section_bold_text_color }}!important; font-size:{{ $be->hero_section_bold_text_font_size }}px;">
                            {{ convertUtf8($be->hero_section_bold_text) }}
                        </h1>
                        @endif
                        @if($be->hero_section_text)
                        <p class="text" data-aos="fade-up" data-aos-delay="100"
                            style="color: #{{ $be->hero_section_text_color }}; font-size: {{ $be->hero_section_text_font_size }}px;">
                            {{ convertUtf8($be->hero_section_text) }}
                        </p>
                        @endif

                        @if ($be->hero_section_button_url)
                            <div class="cta-btn mt-40" data-aos="fade-up" data-aos-delay="250">
                                <a href="{{ $be->hero_section_button_url }}" class="btn btn-lg btn-secondary"
                                    title="{{ convertUtf8($be->hero_section_button_text) }}" target="_self"
                                    style="background-color: #{{ $be->hero_section_button_color }}; font-size: {{ $be->hero_section_button_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_color }}">{{ convertUtf8($be->hero_section_button_text) }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="banner-image mb-40 parallax-img text-center" data-speed="0.1" data-revert="true">
                    <img class="lazyload blur-up"
                        src="{{ $be->hero_side_img ? asset('assets/front/img/' . $be->hero_side_img) : '' }}"
                        data-src="{{ $be->hero_side_img ? asset('assets/front/img/' . $be->hero_side_img) : '' }}"
                        alt="Banner Image">
                </div>
            </div>
        </div>
        @if ($be->hero_section_water_shape_text)
            <span class="big-text d-none d-lg-block"
                style="font-size: {{ $be->hero_section_water_shape_text_font_size }}px !important">{{ $be->hero_section_water_shape_text }}</span>
        @endif
    </div>
    <div class="bg-img" data-bg-image="{{ $be->hero_bg ? asset('assets/front/img/' . $be->hero_bg) : '' }}"></div>
    <!-- Bg shape -->
    @if ($be->hero_shape_img)
        <div class="bg-shape h-auto">
            <img class="lazyload"
                data-src="{{ $be->hero_shape_img ? asset('assets/front/img/' . $be->hero_shape_img) : '' }}"
                alt="Bg Shape">
        </div>
    @endif
</section>
