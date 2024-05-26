@extends('admin.layout')

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
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">Intro Point</div>
                        </div>
                        <div class="col-lg-3">
                            @if (!empty($langs))
                                <select name="language" class="form-control"
                                    onchange="window.location='{{ url()->current() . '?language=' }}'+this.value">
                                    <option value="" selected disabled>Select a Language</option>
                                    @foreach ($langs as $lang)
                                        <option value="{{ $lang->code }}"
                                            {{ $lang->code == request()->input('language') ? 'selected' : '' }}>
                                            {{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-primary float-lg-right float-left" data-toggle="modal"
                                data-target="#createModal"><i class="fas fa-plus"></i> Add Intro Point</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($features) == 0)
                                <h3 class="text-center">NO Intro Point FOUND</h3>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>

                                                @if (
                                                    $activeTheme == 'multipurpose' ||
                                                        $activeTheme == 'pizza' ||
                                                        $activeTheme == 'grocery' ||
                                                        $activeTheme == 'medicine' ||
                                                        $activeTheme == 'bakery')
                                                    <th scope="col">Icon</th>
                                                @endif

                                                <th scope="col">Title</th>

                                                @if (
                                                    $activeTheme == 'multipurpose' ||
                                                        $activeTheme == 'pizza' ||
                                                        $activeTheme == 'grocery' ||
                                                        $activeTheme == 'medicine' ||
                                                        $activeTheme == 'bakery')
                                                    <th scope="col">Text </th>
                                                @endif

                                                @if ($activeTheme == 'coffee' || $activeTheme == 'medicine' || $activeTheme == 'beverage')
                                                    <th scope="col">Rating Point</th>
                                                    <th scope="col">Rating Symbol</th>
                                                @endif

                                                <th scope="col">Serial Number</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($features as $key => $feature)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @if (
                                                        $activeTheme == 'multipurpose' ||
                                                            $activeTheme == 'pizza' ||
                                                            $activeTheme == 'grocery' ||
                                                            $activeTheme == 'medicine' ||
                                                            $activeTheme == 'bakery')
                                                        <td>
                                                            
                                                            <i class="{{ $feature->icon }}"></i>
                                                            
                                                         

                                                        </td>
                                                    @endif

                                                    <td>{{ convertUtf8($feature->title) }}</td>

                                                    @if (
                                                        $activeTheme == 'multipurpose' ||
                                                            $activeTheme == 'pizza' ||
                                                            $activeTheme == 'grocery' ||
                                                            $activeTheme == 'medicine' ||
                                                            $activeTheme == 'bakery')
                                                        <td>{{ convertUtf8($feature->text) }}</td>
                                                    @endif

                                                    @if ($activeTheme == 'coffee' || $activeTheme == 'medicine' || $activeTheme == 'beverage')
                                                        <td>{{ $feature->intro_section_rating_point }}</td>
                                                        <td>
                                                            {{ $feature->intro_section_rating_symbol }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $feature->serial_number }}</td>
                                                    <td>
                                                        <a class="btn btn-secondary btn-sm"
                                                            href="{{ route('admin.intro.point.edit', $feature->id) . '?language=' . request()->input('language') }}">
                                                            <span class="btn-label">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            Edit
                                                        </a>
                                                        <form class="deleteform d-inline-block"
                                                            action="{{ route('admin.intro.point.delete') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="feature_id"
                                                                value="{{ $feature->id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                                <span class="btn-label">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Feature Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Intro Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ajaxForm" class="modal-form" action="{{ route('admin.intro.point.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Language **</label>
                            <select name="language_id" class="form-control" required>
                                <option value="" selected disabled>Select a language</option>
                                @foreach ($langs as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            <p id="errlanguage_id" class="mb-0 text-danger em"></p>
                        </div>
                        @if (
                            $activeTheme == 'multipurpose' ||
                                $activeTheme == 'pizza' ||
                                $activeTheme == 'grocery' ||
                                $activeTheme == 'medicine' ||
                                $activeTheme == 'bakery')
                                
                            {{-- //Icon Picker --}}

                            <div class="form-group">
                                <label for="">{{ __('Icon') }} **</label>
                                <div class="btn-group d-block">
                                    <button type="button" class="btn btn-primary iconpicker-component"><i
                                            class="fa fa-fw fa-heart"></i></button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fa-car" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input id="inputIcon" type="hidden" name="icon" value="fas fa-heart">
                                @if ($errors->has('icon'))
                                    <p class="mb-0 text-danger">{{ $errors->first('icon') }}</p>
                                @endif
                                <div class="mt-2">
                                    <small>{{ __('NB: click on the dropdown sign to select a icon.') }}</small>
                                </div>
                                <p id="erricon" class="mb-0 text-danger em"></p>
                            </div>



                            {{-- //Icon Picker --}}
                        @endif
                        <div class="form-group">
                            <label for="">Title **</label>
                            <input class="form-control" name="title" placeholder="Enter Title" required>
                            <p id="errtitle" class="mb-0 text-danger em"></p>
                        </div>
                        @if (
                            $activeTheme == 'multipurpose' ||
                                $activeTheme == 'pizza' ||
                                $activeTheme == 'grocery' ||
                                $activeTheme == 'medicine' ||
                                $activeTheme == 'bakery')
                            <div class="form-group">
                                <label for="">Text</label>
                                <input class="form-control" name="text" placeholder="Enter Text">
                                <p id="errtext" class="mb-0 text-danger em"></p>
                            </div>
                        @endif
                        @if ($activeTheme == 'coffee' || $activeTheme == 'medicine' || $activeTheme == 'beverage')
                            <div class="form-group">
                                <label for="">Rating Point</label>
                                <input class="form-control" type="number" name="intro_section_rating_point"
                                    placeholder="Enter Rating Point">
                                <p id="errintro_section_rating_point" class="mb-0 text-danger em"></p>
                            </div>
                            <div class="form-group">
                                <label for="">Rating Symbol</label>
                                <input class="form-control" name="intro_section_rating_symbol"
                                    placeholder="Enter Rating Symbol">
                                <p id="errintro_section_rating_symbol" class="mb-0 text-danger em"></p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Serial Number **</label>
                            <input type="number" class="form-control ltr" name="serial_number" value=""
                                placeholder="Enter Serial Number">
                            <p id="errserial_number" class="mb-0 text-danger em"></p>
                            <p class="text-warning"><small>The higher the serial number is, the later the intro point will be
                                    shown.</small></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

@endsection
