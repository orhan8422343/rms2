<section class="about-area about-5 pb-60">
    <div class="container">
        <div class="row align-items-center gx-xl-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="image mb-40">
                    <img class="lazyload blur-up" src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}"
                        data-src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}" alt="Image">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="content-title mb-40">
                    <h2 class="title mb-30">
                        {{ convertUtf8($bs->intro_title) }}
                    </h2>
                    <div class="info-list mb-10">
                        <div class="row">
                            @foreach ($intro_feature_items as $item)
                            <div class="col-md-6 mb-30 item">
                                <div class="card align-items-center">
                                    <div class="card-icon rounded-pill">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                    <div class="card-content">
                                        <h6 class="card-title mb-2">{{ $item->title }}</h6>
                                        <p class="card-text">
                                            {{ $item->text}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>

                    @if($bs->intro_section_button_url)
                    <a href="{{$bs->intro_section_button_url}}" class="btn btn-lg btn-primary" title="{{ $bs->intro_section_button_text}}" target="_self" style="background-color:#{{ $bs->base_color }} !important; border: 2px solid #{{ $bs->base_color }} !important ;">{{ $bs->intro_section_button_text}}</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>