@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">Themes</h4>
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
                <a href="#">Settings</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Themes</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title">{{ __('Theme Settings') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm" action="{{ route("admin.theme.update") }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">{{ __('Theme') }} *</label>
                                    <div class="row">
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="multipurpose"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'multipurpose' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/multipurpose.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                         
                                            
                                                <div class="form-group Home_version">
                                                    <label>Home Version **</label>
                                                    <select name="home_version" class="form-control" required>
                                                        <option value="static" {{$abs->home_version == 'static' ? 'selected' : ''}}>Static Version</option>
                                                        <option value="slider" {{$abs->home_version == 'slider' ? 'selected' : ''}}>Slider Version</option>
                                                        <option value="video" {{$abs->home_version == 'video' ? 'selected' : ''}}>Video Version</option>
                                                        <option value="particles" {{$abs->home_version == 'particles' ? 'selected' : ''}}>Particles Version</option>
                                                        <option value="water" {{$abs->home_version == 'water' ? 'selected' : ''}}>Water Version</option>
                                                        <option value="parallax" {{$abs->home_version == 'parallax' ? 'selected' : ''}}>Parallax Version</option>
                                                    </select>
                                                </div>
                                           

                                            <h5 class="text-center">{{__('Multipurpose Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="bakery"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'bakery' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/bakery.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Bakery Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="pizza"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'pizza' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/pizza.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Pizza Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="coffee"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'coffee' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/coffee.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Coffee Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="medicine"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'medicine' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/medicine.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Medicine Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="grocery"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'grocery' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/grocery.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Grocery Theme')}}</h5>
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="imagecheck mb-2">
                                                <input name="theme" type="radio" value="beverage"
                                                    class="imagecheck-input"
                                                    {{ !empty($abs->theme) && $abs->theme == 'beverage' ? 'checked' : '' }}>
                                                <figure class="imagecheck-figure">
                                                    <img src="{{ asset('assets/admin/img/themes/beverage.png') }}"
                                                        alt="title" class="imagecheck-image">
                                                </figure>
                                            </label>
                                            <h5 class="text-center">{{__('Beverage Theme')}}</h5>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" id="submitBtn" class="btn btn-success">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){

   

    function themeExtrafeature(){
        const selectedTheme = $('input[name="theme"]:checked').val();
        if(selectedTheme == "multipurpose"){
            $('.Home_version').css({'display':'block'});
        }
        else{
            $('.Home_version').css({'display':'none'});
        }
    }
    themeExtrafeature();

    $(".imagecheck").on("change",function(){
        themeExtrafeature();
    });



});

    
</script>
@endsection
