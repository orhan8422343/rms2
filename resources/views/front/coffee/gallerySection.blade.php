<section class="gallery-area">
    <div class="container">
        <div class="swiper gallery-slider" data-aos="fade-up">
            <div class="swiper-wrapper">

                @foreach($galleries as $gallery)
                <div class="swiper-slide">
                    <a href="#" class="slider-item" title="{{ $gallery->title }}" target="_blank">
                        <div class="lazy-container ratio ratio-2-3">
                            <img class="lazyload" src="{{asset('assets/front/img/gallery/'.$gallery->image)}}" data-src="{{asset('assets/front/img/gallery/'.$gallery->image)}}" alt="Image">
                        </div>
                        {{-- <div class="icon rounded-pill"><img class="lazyload blur-up" src="{{asset('assets/front/img/gallery/'.$gallery->image)}}" data-src="{{asset('assets/front/img/gallery/'.$gallery->image)}}" alt="Image"></div> --}}
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>