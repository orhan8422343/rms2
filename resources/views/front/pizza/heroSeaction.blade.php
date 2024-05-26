
    <section class="hero-banner hero-banner-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">

                    <div class="banner-content mw-100">
                        
                        @if ($be->hero_section_bold_text)
                            <h1 class="title color-white mb-30 mt-1" data-aos="fade-up" data-aos-delay="100"
                                style="color: #{{ $be->hero_section_bold_text_color }} !important; font-size :{{ $be->hero_section_bold_text_font_size }}px !important">
                                {{ $be->hero_section_bold_text }}
                            </h1>
                        @endif
                        @if ($be->hero_section_text)
                        <p class="text color-light" data-aos="fade-up" data-aos-delay="100"
                            style="color: #{{ $be->hero_section_text_color }} !important; font-size :{{ $be->hero_section_text_font_size }}px !important">
                            {{ $be->hero_section_text }}
                        </p>
                       @endif
                  

                        <div class="cta-btn mt-30 btn-groups justify-content-center" data-aos="fade-up"
                            data-aos-delay="250">
                            @if ($be->hero_section_button_url)
                                <a href="{{ $be->hero_section_button_url }}" class="btn btn-lg btn-primary rounded-pill"
                                    title="{{ convertUtf8($be->hero_section_button_text) }}" target="_self"
                                    style="background-color:#{{ $be->hero_section_button_color }};border: 2px solid #{{ $be->hero_section_button_color }};font-size: {{ $be->hero_section_button_text_font_size }}px;">{{ convertUtf8($be->hero_section_button_text) }}</a>
                            @endif
                            @if ($be->hero_section_button2_url)
                                <a href="{{ $be->hero_section_button2_url }}"
                                    class="btn btn-lg btn-outline rounded-pill"
                                    title="{{ $be->hero_section_button2_text }}" target="_self"
                                    style="background-color:#{{ $be->hero_section_button_two_color }};font-size: {{ $be->hero_section_button2_text_font_size }}px;">{{ $be->hero_section_button2_text }}</a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Bg image -->
        @if($be->hero_bg)
        <div class="bg-img" data-bg-image="{{ $be->hero_bg ? asset('assets/front/img/' . $be->hero_bg) : '' }}"></div>
        @endif
        <!-- Bg shape -->
        @if($be->hero_shape_img)
        <div class="bg-shape h-auto">
            <img class="lazyload"
                data-src="{{ $be->hero_shape_img ? asset('assets/front/img/' . $be->hero_shape_img) : '' }}"
                alt="Bg Shape">
        </div>
        @endif
    </section>
  
