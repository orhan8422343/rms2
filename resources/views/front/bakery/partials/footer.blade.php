<footer class="footer-area bg-img bg-cover" data-bg-image="{{ asset('assets/front/img/' . $be->footer_section_bg_image) }}">
<div class="overlay opacity-90"></div>
@if ($bs->top_footer_section == 1)
<div class="footer-top pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer-widget" data-aos="fade-up" data-aos-delay="100">
                    <div class="navbar-brand">
                        <a href="{{ route('front.index') }}" target="_self" title="Link">
                            <img src="{{ asset('assets/front/img/' . $bs->footer_logo) }}" alt="Logo">
                        </a>
                    </div>
                    <p>{{ convertUtf8($bs->footer_text) }}</p>

                    @if (!empty($be->footer_bottom_img))
                    <a class="pt-30" href="javascript:;">
                        <img class="lazy" data-src="{{ asset('assets/front/img/' . $be->footer_bottom_img) }}"
                            alt="" src="{{ asset('assets/front/img/' . $be->footer_bottom_img) }}">
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="footer-widget" data-aos="fade-up" data-aos-delay="200">
                    <h5>{{ __('Useful Links') }}</h5>
                    <ul class="footer-links">
                        <!---Start of Useful Link--->

                        @php
                            $ulinks = App\Models\Ulink::where('language_id', $currentLang->id)
                                ->orderby('id', 'desc')
                                ->get();
                        @endphp

                        @foreach ($ulinks as $ulink)
                            <li>
                                <a href="{{ $ulink->url }}" target="_self"
                                    title="{{ convertUtf8($ulink->name) }}">{{ convertUtf8($ulink->name) }}</a>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">
                <div class="footer-widget" data-aos="fade-up" data-aos-delay="400">
                    <h5>{{ __('Contact Us') }}</h5>
                    <ul class="info-list">
                        <li>
                            <i class="fal fa-map-marker-alt"></i>
                            <span>{{ $bs->contact_address }}</span>
                        </li>
                        @php
                        $numbers = explode(",",$bs->contact_number)
                        @endphp

                        @if($numbers)
                        <li>
                            <i class="fal fa-headset"></i>
                            @foreach($numbers as $number)
                            <a href="tel:{{ $number }}">{{ $number }}</a>
                            @endforeach
                        </li>
                        @endif
                        @php
                        $mails = explode(",",$bs->contact_mails)
                        @endphp
                        @if($mails)
                        <li>

                            <i class="fal fa-envelope"></i>
                            @foreach($mails as $mail)
                            <a href="mailto:{{ $mail }}">{{ $mail }}</a>
                            @endforeach
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">
                <div class="footer-widget" data-aos="fade-up" data-aos-delay="200">
                    <h5>{{ __('Subscribe Here') }}</h5>
                    <p class="lh-1 mb-20">{{ __('Stay update with us and get offer!') }}</p>
                    <div class="newsletter-form">
                        <form id="footerSubscribe" action="{{ route('front.subscribe') }}" method="post" class="subscribeForm" >
                            @csrf
                            <div class="form-group">
                                <input class="form-control shadow-md rounded-pill"
                                    placeholder="{{ __('Enter Your Email') }}" type="text" name="email"
                                    required="" autocomplete="off">

                                <button class="btn btn-md btn-primary no-animation rounded-pill"
                                    type="submit">{{ __('Subscribe')}}</button>
                                </div>
                                <p id="erremail" class="text-danger mb-0 err-email"></p>
                        </form>

                    </div>
                    <div class="social-link mt-20">
                        @foreach ($socials as $social_link)
                            <a href="{{ $social_link->url }}" target="_blank"><i
                                    class="{{ $social_link->icon }}"></i></a>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if ($bs->copyright_section == 1)
    <div class="copy-right-area border-top ptb-30">
        <div class="container">
            <div class="copy-right-content">
                <span>
                    {!! nl2br(replaceBaseUrl(convertUtf8($bs->copyright_text))) !!}
                </span>
            </div>
        </div>
    </div>
@endif
</footer>
