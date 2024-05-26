<section class="hero-banner hero-banner-3 parallax pb-100">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6">
                <div class="fluid-left">
                    <div class="banner-content mb-40">
                        @if ($be->hero_section_bold_text)
                            <h1 class="title color-white mb-30" data-aos="fade-up" data-aos-delay="100"
                                style="color: #{{ $be->hero_section_bold_text_color }} !important; font-size
                                :{{ $be->hero_section_bold_text_font_size }}px !important">
                                {{ $be->hero_section_bold_text }}
                            </h1>
                        @endif

                        @if ($be->hero_section_text)
                            <p class="text color-light" data-aos="fade-up" data-aos-delay="100"
                                style="color: #{{ $be->hero_section_text_color }} !important; font-size :{{ $be->hero_section_text_font_size }}px !important">
                                {{ $be->hero_section_text }}
                            </p>
                        @endif

                        <div class="cta-btn mt-40 btn-groups" data-aos="fade-up" data-aos-delay="250">
                            @if ($be->hero_section_button_url)
                                <a href="{{ $be->hero_section_button_url }}" class="btn btn-lg btn-primary"
                                    title="{{ convertUtf8($be->hero_section_button_text) }} More" target="_self"
                                    style="background-color: #{{ $be->hero_section_button_color }}; font-size: {{ $be->hero_section_button_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_color }}">{{ convertUtf8($be->hero_section_button_text) }}</a>
                            @endif

                            @if ($be->hero_section_button2_url)
                                <a href="{{ $be->hero_section_button2_url }}" class="btn btn-lg btn-outline"
                                    title=" {{ $be->hero_section_button2_text }}" target="_self"
                                    style="background-color: #{{ $be->hero_section_button_two_color }}; font-size: {{ $be->hero_section_button2_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_two_color }}">{{ $be->hero_section_button2_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="banner-image mb-40 parallax-img" data-speed="0.1" data-revert="true">
                    <img class="lazyload blur-up"
                        src="{{ $be->hero_side_img ? asset('assets/front/img/' . $be->hero_side_img) : '' }}"
                        data-src="{{ $be->hero_side_img ? asset('assets/front/img/' . $be->hero_side_img) : '' }}"
                        alt="Banner side Image">

                </div>
            </div>
        </div>
    </div>
    @if ($be->hero_bg)
        <div class="bg-img" data-bg-image="{{ $be->hero_bg ? asset('assets/front/img/' . $be->hero_bg) : '' }}"></div>
    @endif
    <!-- Spacer -->
    <div class="spacer pb-120"></div>
    <!-- Bg shape -->
    @if ($be->hero_shape_img)
        <div class="bg-shape h-auto">
            <img class="lazyload"
                data-src="{{ $be->hero_shape_img ? asset('assets/front/img/' . $be->hero_shape_img) : '' }}"
                alt="Bg Shape">
        </div>
    @endif
</section>
