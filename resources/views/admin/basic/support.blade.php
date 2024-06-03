@extends('admin.layout')

@if(!empty($abs->language) && $abs->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
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
  <div class="page-header">
    <h4 class="page-title">خدمة العملاء</h4>
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
        <a href="#">خدمة العملاء</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.support.update', $lang_id)}}" method="POST">
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-10">
                      <div class="card-title">معلومات خدمة العملاء</div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>الإيميل</label>
                  <input class="form-control ltr" name="support_email" value="{{$abs->support_email}}" placeholder="Email">
                  @if ($errors->has('support_email'))
                    <p class="mb-0 text-danger">{{$errors->first('support_email')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>رقم الهاتف</label>
                  <input class="form-control" name="support_phone" value="{{$abs->support_phone}}" placeholder="Phone">
                  @if ($errors->has('support_phone'))
                    <p class="mb-0 text-danger">{{$errors->first('support_phone')}}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-lg-3 col-md-3 col-sm-12">

                </div>
                <div class="col-12 text-center">
                  <button id="displayNotif" class="btn btn-success">تحديث</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
