@extends('admin.layout')


@if (!empty($feature->language) && $feature->language->rtl == 1)
    @section('styles')
        <style>
            form input,
            form textarea,
            form select {
                direction: rtl;
            }

            .nicEdit-main {
                direction: rtl;
                text-align: right;
            }
        </style>
    @endsection
@endif

@section('content')
    <div class="page-header">
        <h4 class="page-title">Intro Point</h4>
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
                <a href="#">Intro Point</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.intro.point.update') }}" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title d-inline-block">Edit Intro Point</div>
                        <a class="btn btn-info btn-sm float-right d-inline-block"
                            href="{{ route('admin.intro.points.index') . '?language=' . request()->input('language') }}">
                            <span class="btn-label">
                                <i class="fas fa-backward"></i>
                            </span>
                            Back
                        </a>
                    </div>
                    <div class="card-body pt-5 pb-5">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                @csrf
                                <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                                @if (
                                    $activeTheme == 'multipurpose' ||
                                        $activeTheme == 'pizza' ||
                                        $activeTheme == 'grocery' ||
                                        $activeTheme == 'medicine' ||
                                        $activeTheme == 'bakery')
                                    <div class="form-group">
                                        <label for="">{{ __('Icon') }} **</label>
                                        <div class="btn-group d-block">
                                            <button type="button" class="btn btn-primary iconpicker-component"><i
                                                    class="{{ $feature->icon }}"></i></button>
                                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="fa-car" data-toggle="dropdown">
                                            </button>
                                            <div class="dropdown-menu"></div>
                                        </div>
                                        <input id="inputIcon" type="hidden" name="icon" value="{{ $feature->icon }}">
                                        @if ($errors->has('icon'))
                                            <p class="mb-0 text-danger">{{ $errors->first('icon') }}</p>
                                        @endif
                                        <div class="mt-2">
                                            <small>{{ __('NB: click on the dropdown sign to select an icon.') }}</small>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="">Title **</label>
                                    <input class="form-control" name="title" placeholder="Enter title"
                                        value="{{ $feature->title }}">
                                    @if ($errors->has('title'))
                                        <p class="mb-0 text-danger">{{ $errors->first('title') }}</p>
                                    @endif
                                </div>


                                @if ($activeTheme == 'coffee' || $activeTheme == 'medicine' || $activeTheme == 'beverage')
                                    <div class="form-group">
                                        <label for="">Rating Point</label>
                                        <input class="form-control" type="number" name="intro_section_rating_point"
                                            value="{{ $feature->intro_section_rating_point }}"
                                            placeholder="Enter Rating Point">
                                        <p id="errintro_section_rating_point" class="mb-0 text-danger em"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Rating Symbol</label>
                                        <input class="form-control" name="intro_section_rating_symbol"
                                            value="{{ $feature->intro_section_rating_symbol }}"
                                            placeholder="Enter Rating Symbol">
                                        <p id="errintro_section_rating_symbol" class="mb-0 text-danger em"></p>
                                    </div>
                                @endif


                                @if (
                                    $activeTheme == 'multipurpose' ||
                                        $activeTheme == 'pizza' ||
                                        $activeTheme == 'grocery' ||
                                        $activeTheme == 'medicine' ||
                                        $activeTheme == 'bakery')
                                    <div class="form-group">
                                        <label for="">Text</label>
                                        <input class="form-control" name="text" placeholder="Enter text"
                                            value="{{ $feature->text }}">
                                        @if ($errors->has('text'))
                                            <p class="mb-0 text-danger">{{ $errors->first('text') }}</p>
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">Serial Number **</label>
                                    <input type="number" class="form-control ltr" name="serial_number"
                                        value="{{ $feature->serial_number }}" placeholder="Enter Serial Number">
                                    @if ($errors->has('serial_number'))
                                        <p class="mb-0 text-danger">{{ $errors->first('serial_number') }}</p>
                                    @endif
                                    <p class="text-warning"><small>The higher the serial number is, the later the intro point
                                            will be shown.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-3">
                        <div class="form">
                            <div class="form-group from-show-notify row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                fd.append('feature_id', {{ $feature->id }});

                $.ajax({
                    url: "{{ route('admin.feature.rmv.img') }}",
                    data: fd,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == "success") {
                            window.location =
                                "{{ url()->current() . '?language=' . $feature->language->code }}";
                        }
                    }
                })
            });
        });
    </script>
@endsection
