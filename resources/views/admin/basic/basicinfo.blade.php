@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">الإعدادات العامة</h4>
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
        <a href="#">الإعدادات</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">الإعدادات العامة</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.basicinfo.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card-title">ضبط الإعدادات</div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <h3 class="text-warning">المعلومات الأساسية</h3>
                  <hr style="border-top: 1px solid #ffffff1a;"><br>

                  <label>عنوان الموقع</label>
                  <input class="form-control" name="website_title" value="{{$abs->website_title}}">
                  @if ($errors->has('website_title'))
                    <p class="mb-0 text-danger">{{$errors->first('website_title')}}</p>
                  @endif
                </div>

                <div class="form-group">
                  <label>أوقات الطلب</label>
                  <input class="form-control" name="office_time" value="{{$bs->office_time}}" placeholder="Office Time">
                  @if ($errors->has('office_time'))
                    <p class="mb-0 text-danger">{{$errors->first('office_time')}}</p>
                  @endif
                </div>

                <div class="form-group">
                    <label for="">المنطقة الزمنية</label>
                    <select class="form-control select" name="timezone">
                        <option value="" selected disabled>Select a Timezone</option>
                        @foreach ($timezones as $timezone)
                        <option value="{{$timezone->timezone}}" {{$be->timezone == $timezone->timezone ? 'selected' : ''}}>{{$timezone->timezone}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <br>
                  <h3 class="text-warning">مظهر الموقع</h3>
                  <hr style="border-top: 1px solid #ffffff1a;"><br>
                  <label>اللون الأساسي</label>
                  <input class="jscolor form-control ltr" name="base_color" value="{{$abs->base_color}}">
                  @if ($errors->has('base_color'))
                    <p class="mb-0 text-danger">{{$errors->first('base_color')}}</p>
                  @endif

                </div>




              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">تحديث</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
