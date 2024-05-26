@extends('admin.layout')

@if (!empty($abe->language) && $abe->language->rtl == 1)
    @section('styles')
        <style>
            form input,
            form textarea,
            form select,
            select {
                direction: rtl;
            }

            form .note-editor.note-frame .note-editing-area .note-editable {
                direction: rtl;
                text-align: right;
            }
        </style>
    @endsection
@endif

@section('content')
    @php
        $section = request()->section;
        $sectionTitle = '';
        if ($section == 'hero_bg') {
            $sectionTitle = 'Hero Section';
        } elseif ($section == 'feature_section_bg_image') {
            $sectionTitle = 'Feature Section';
        } elseif ($section == 'special_section_bg_image') {
            $sectionTitle = 'Special Section';
        } elseif ($section == 'footer_section_bg_image') {
            $sectionTitle = 'Footer Section';
        }
    @endphp
    <div class="page-header">
        <h4 class="page-title">Hero Section</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Website Pages</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Home Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $sectionTitle }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Background Image</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        @php
                        $section = request()->section;
                        $sectionName ='';
                        if($section == "testimonial_bg_img")
                        {
                            $sectionName = "Testimonial Section";
                        }elseif($section == 'footer_section_bg_image'){
                            $sectionName = "Footer Section";
                        }elseif($section == 'footer_section_bg_image'){
                            $sectionName = "Footer Section";
                        }elseif($section == 'intro_bg_image'){
                            $sectionName = "Intro Section";
                        }elseif($section == 'feature_section_bg_image'){
                            $sectionName = "Feature Section";
                        }elseif($section == "blog_section_bg_image"){
                            $sectionName = "Blog Section";
                        }

                        @endphp
                        <div class="col-lg-10">
                            <div class="card-title">Update {{ $sectionName }} Background Image</div>
                        </div>
                        <div class="col-lg-2">
                            @if (!empty($langs))
                                <select name="language" class="form-control"
                                    onchange="window.location='{{ url()->current() . '?language=' }}'+this.value +'&section=' + '{{ $section }}'">
                                    <option value="" selected disabled>Select a Language</option>
                                    @foreach ($langs as $lang)
                                        <option value="{{ $lang->code }}"
                                            {{ $lang->code == request()->input('language') ? 'selected' : '' }}>
                                            {{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-4">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm" action="{{ route('admin.backgroundImage.update', $lang_id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="form-group">
                                            <div class="mb-2">
                                                <label for="image"><strong>Background Image</strong></label>
                                            </div>


                                            @if ($section == 'testimonial_bg_img')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->testimonial_bg_img))
                                                        <a class="remove-image" data-type="testimonial_bg_img"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->testimonial_bg_img) ? asset('assets/front/img/' . $abe->testimonial_bg_img) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="testimonial_bg_img" class="form-control image">
                                                <p id="errtestimonial_bg_img" class="mb-0 text-danger em"></p>
                                            @elseif($section == 'feature_section_bg_image')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->feature_section_bg_image))
                                                        <a class="remove-image" data-type="feature_section_bg_image"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->feature_section_bg_image) ? asset('assets/front/img/' . $abe->feature_section_bg_image) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="feature_section_bg_image"
                                                    class="form-control image">
                                                <p id="errfeature_section_bg_image" class="mb-0 text-danger em"></p>
                                            @elseif($section == 'special_section_bg_image')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->special_section_bg_image))
                                                        <a class="remove-image" data-type="special_section_bg_image"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->special_section_bg_image) ? asset('assets/front/img/' . $abe->special_section_bg_image) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="special_section_bg_image"
                                                    class="form-control image">
                                                <p id="errspecial_section_bg_image" class="mb-0 text-danger em"></p>
                                            @elseif($section == 'intro_bg_image')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->intro_bg_image))
                                                        <a class="remove-image" data-type="intro_bg_image"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->intro_bg_image) ? asset('assets/front/img/' . $abe->intro_bg_image) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="intro_bg_image"
                                                    class="form-control image">
                                                <p id="errintro_bg_image" class="mb-0 text-danger em"></p>
                                            @elseif($section == 'blog_section_bg_image')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->blog_section_bg_image))
                                                        <a class="remove-image" data-type="blog_section_bg_image"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->blog_section_bg_image) ? asset('assets/front/img/' . $abe->blog_section_bg_image) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="blog_section_bg_image"
                                                    class="form-control image">
                                                <p id="errblog_section_bg_image" class="mb-0 text-danger em"></p>
                                            @elseif($section == 'footer_section_bg_image')
                                                <div class="showImage mb-3">
                                                    @if (!empty($abe->footer_section_bg_image))
                                                        <a class="remove-image" data-type="footer_section_bg_image"><i
                                                                class="far fa-times-circle"></i></a>
                                                    @endif
                                                    <img src="{{ !empty($abe->footer_section_bg_image) ? asset('assets/front/img/' . $abe->footer_section_bg_image) : asset('assets/admin/img/noimage.jpg') }}"
                                                        alt="..." class="img-thumbnail w-100">
                                                </div>
                                                <input type="file" name="footer_section_bg_image"
                                                    class="form-control image">
                                                <p id="errfooter_section_bg_image" class="mb-0 text-danger em"></p>
                                            @endif


                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center mx-auto">
                                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @dd(url()->full()) --}}
@endsection


@section('scripts')
    <script>
        $(function($) {
            "use strict";

            $(".remove-image").on('click', function(e) {
                e.preventDefault();
                $(".request-loader").addClass("show");

                let type = $(this).data('type');
                let fd = new FormData();
                fd.append('type', type);
                fd.append('language_id', {{ $abe->language->id }});

                $.ajax({
                    url: "{{ route('admin.backgroundimage.rmvimg') }}",
                    data: fd,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == "success") {
                            window.location =
                     
                                "{{ url()->current() . '?language=' . $abe->language->code}}"+'&section='+type;
                        }
                    }
                })
            });
        });
    </script>
@endsection
