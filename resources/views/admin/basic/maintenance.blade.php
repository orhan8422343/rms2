@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Maintenance Mode</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
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
        <a href="#">Maintenance Mode</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">

          <div class="card-header">
            <div class="card-title">Update Maintenance Page & Mode</div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <form  action="{{route('admin.maintenance.update')}}" method="post" enctype="multipart/form-data" id="maintenanceForm">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <div class="col-12 mb-2">
                          <label for="image"><strong>maintenance Image **</strong></label>
                        </div>
                        <div class="col-md-12 showImage mb-3">
                          <img src="{{ asset('assets/front/img/'. 'maintenance.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <input type="file" name="file" id="image" class="form-control">
                        <p id="errfile" class="mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Maintenance Mode **</label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="maintenance_mode" value="1" class="selectgroup-input" {{$bs->maintenance_mode == 1 ? 'checked' : ''}}>
                        <span class="selectgroup-button">Active</span>
                      </label>
                      <label class="selectgroup-item">
                        <input type="radio" name="maintenance_mode" value="0" class="selectgroup-input" {{$bs->maintenance_mode == 0 ? 'checked' : ''}}>
                        <span class="selectgroup-button">Deactive</span>
                      </label>
                    </div>
                    @if ($errors->has('maintenance_mode'))
                      <p class="mb-0 text-danger">{{$errors->first('maintenance_mode')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Maintanance Text</label>
                    <textarea class="form-control" name="maintenance_text" rows="3" cols="80">{{ replaceBaseUrl($bs->maintenance_text) }}</textarea>
                    @if ($errors->has('maintenance_text'))
                      <p class="mb-0 text-danger">{{$errors->first('maintenance_text')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Secret Path</label>
                    <input name="secret_path" type="text" class="form-control" value="{{$bs->ips}}">
                    @if ($errors->has('secret_path'))
                    <p class="mb-0 text-danger">{{$errors->first('secret_path')}}</p>
                    @endif
                    <p class="text-warning">{{__('After activating maintenance mode, You can access the website via')}} <strong class="text-danger">{{url('{secret_path}')}}</strong></p>
                    <p class="text-warning">{{__('Try to avoid using special characters')}}</p>
                  </div>

                </form>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit"  class="btn btn-success" form="maintenanceForm">Update</button>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>

@endsection
