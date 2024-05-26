@if ($bs->top_footer_section == 1)
    <footer class="footer-area footer-area-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget-1">
                        <div class="header-times d-none d-md-inline-block">
                            <i class="flaticon-time"></i>
                            <h5>{{ __('Opening Time') }}</h5>
                            <span>{{ convertUtf8($bs->office_time) }}</span>
                        </div>
                        <p>{{ convertUtf8($bs->footer_text) }}</p>

                        <div class="add-to">
                            <button class="add-to-btn">Add to home screen</button>
                        </div>

                        <ul>
                            @foreach ($socials as $social_link)
                                <li><a href="{{ $social_link->url }}"><i class="{{ $social_link->icon }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 order-3 order-lg-2">
                    <div
                        class="footer-widget-2 text-left text-sm-center >
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('assets/front/img/' . $bs->footer_logo) }}" alt="logo"></a>
                        <ul class="pt-25">
                            @php
                                $blinks = App\Models\Bottomlink::where('language_id', $currentLang->id)
                                    ->orderby('id', 'desc')
                                    ->get();

                                  
                                    
                            @endphp
                            @foreach ($blinks as $blink)
                                <li><a href="{{ $blink->url }}">{{ convertUtf8($blink->name) }}</a></li>
                            @endforeach
                        </ul>
                        @if (!empty($be->footer_bottom_img))
                            <a class="pt-30" href="javascript:;">
                                <img class="lazy" data-src="{{ asset('assets/front/img/' . $be->footer_bottom_img) }}"
                                    alt="">
                            </a>
                        @endif
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-6 order-2 order-lg-3">
                    <h3 class="subscribe-title">{{ __('Subscribe Here') }}</h3>
                    <form id="footerSubscribe" action="{{ route('front.subscribe') }}" method="post"
                        class="subscribe-form subscribeForm">
                        @csrf
                        <div class="subscribe-inputs">
                            <input name="email" type="text" placeholder="{{ __('Enter Your Email') }}">
                            <button type="submit"><i class="far fa-paper-plane"></i></button>
                        </div>
                        <p id="erremail" class="text-danger mb-0 err-email"></p>
                    </form>
                    <div class="footer-widget-3">
                        <ul>
                            @php
                                $ulinks = App\Models\Ulink::where('language_id', $currentLang->id)
                                    ->orderby('id', 'desc')
                                    ->get();
                            @endphp

                            @foreach ($ulinks as $ulink)
                                <li><a href="{{ $ulink->url }}">+ {{ convertUtf8($ulink->name) }}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </div> --}}
            </div>
        </div>
    </footer>
@endif
@if ($bs->copyright_section == 1)
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright d-block justify-content-center d-md-flex">
                        {!! nl2br(replaceBaseUrl(convertUtf8($bs->copyright_text))) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
