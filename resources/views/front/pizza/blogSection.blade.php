    <!-- Blog-area start -->
    <section class="blog-area blog-2 pt-100 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <div class="section-title title-center mb-50" data-aos="fade-up">
                            <div>
                                <h2 class="title"> {{ convertUtf8( $bs->blog_section_title)}} </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        @forelse($blogs as $blog)
                            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                                <article class="card mb-25 radius-md">
                                    <div class="card-img">
                                        <a href="{{ route('front.blogdetails', [$blog->slug, $blog->id]) }}"
                                            target="_self" title="Link" class="lazy-container ratio ratio-1-2">
                                            <img class="lazyload"
                                                src="{{ asset('assets/front/img/blogs/' . $blog->main_image) }}"
                                                data-src="{{ asset('assets/front/img/blogs/' . $blog->main_image) }}"
                                                alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="card-content radius-md p-25">
                                        <ul
                                            class="card-list list-unstyled mb-15 rounded-pill px-3  py-2 justify-content-between">
                                            <li class="icon-start">
                                                <a target="_self" title="" class="disabled-link"><i
                                                        class="fal fa-user"></i>{{__('By')}} {{ __('Admin') }}</a>
                                            </li>
                                            <li class="icon-start">
                                                <a target="_self" title="" class="disabled-link"><i
                                                        class="fal fa-calendar-check"></i>{{ \Carbon\carbon::parse($blog->created_at)->format('d.m.Y') }}</a>
                                            </li>
                                            @if ($blog->bcategory)
                                                <li class="icon-start">
                                                    <a href="{{ route('front.blogs', ['category' => $blog->bcategory->id]) }}"
                                                        target="_self" title="{{ $blog->bcategory->name }}"><i
                                                            class="fal fa-tag"></i>{{ $blog->bcategory ? $blog->bcategory->name : '' }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <h4 class="card-title lc-2 mb-0 color-white">
                                            <a href="{{ route('front.blogdetails', [$blog->slug, $blog->id]) }}"
                                                target="_self" title="{{ convertUtf8($blog->title) }}">
                                                {{ convertUtf8($blog->title) }}
                                            </a>
                                        </h4>
                                        <p class="card-text lc-3 hover-show color-light mt-15">
                                            {{ strlen(strip_tags(convertUtf8($blog->content))) > 100 ? substr(strip_tags(convertUtf8($blog->content)), 0, 100) . '...' : strip_tags(convertUtf8($blog->content)) }}
                                        </p>
                                        <a href="{{ route('front.blogdetails', [$blog->slug, $blog->id]) }}"
                                            class="btn-text color-primary" target="_self"
                                            title="{{ __('Read More') }}">{{ __('Read More') }}</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach

                    </div>
                    <div class="cta-btn text-center mt-15 mb-25">
                        <a href="{{ route('front.blogs') }}" class="btn btn-lg btn-primary rounded-pill"
                            title="{{ __('View More Items') }}" target="_self">{{ __('View More Items') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog-area end -->
