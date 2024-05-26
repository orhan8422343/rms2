<section class="hero-banner hero-banner-5">
    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6">
                <div class="banner-content mb-40">
                    @if($be->hero_section_bold_text)
                    <h1 class="title mb-30" data-aos="fade-up" data-aos-delay="100" style="color: #{{ $be->hero_section_bold_text_color }} !important; font-size :{{ $be->hero_section_bold_text_font_size }}px !important">
                        {{ $be->hero_section_bold_text }}
                    </h1>
                    @endif
                    @if($be->hero_section_text )
                    <p class="text color-dark" data-aos="fade-up" data-aos-delay="100" style="color: #{{ $be->hero_section_text_color }} !important; font-size :{{ $be->hero_section_text_font_size }}px !important">
                        {{ $be->hero_section_text }}
                    </p>
                    @endif
                    <div class="cta-btn mt-40 btn-groups" data-aos="fade-up"
                        data-aos-delay="250">

                        @if($be->hero_section_button_url)
                        <a href="{{ $be->hero_section_button_url }}" class="btn btn-lg btn-primary " title="{{ convertUtf8($be->hero_section_button_text) }}"
                            target="_self" style="background: #{{ $be->hero_section_button_color }}; font-size: {{ $be->hero_section_button_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_color }}!important">{{ convertUtf8($be->hero_section_button_text) }}</a>
                        @endif
                        
                        @if($be->hero_section_button2_url)
                        <a href="{{ $be->hero_section_button2_url }}" class="btn btn-lg btn-outline  border-0" title="{{ $be->hero_section_button2_text }}"
                            target="_self" style="background: #{{ $be->hero_section_button_two_color }}; font-size: {{ $be->hero_section_button2_text_font_size }}px; border:1px solid #{{ $be->hero_section_button_two_color }} !important">{{ $be->hero_section_button2_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($be->hero_bg)
    <div class="bg-img" data-bg-image="{{ $be->hero_bg ? asset('assets/front/img/'. $be->hero_bg ) : '' }}"></div>
    @endif
</section>