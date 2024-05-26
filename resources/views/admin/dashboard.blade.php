@extends('admin.layout')

@section('content')
    <div class="mt-2 mb-4">
        <h2 class="text-white pb-2">أهلًا، {{ Auth::guard('admin')->user()->first_name }}
            {{ Auth::guard('admin')->user()->last_name }}!</h2>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">أعضاء الفريق</p>
                                <h4 class="card-title">{{ $currentLang->members()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-warning card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fab fa-blogger-b"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">المقالات</p>
                                <h4 class="card-title">{{ $currentLang->blogs()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fab fa-product-hunt"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">الأطعمة</p>
                                <h4 class="card-title">{{ $currentLang->products()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-info card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">مستخدمي النظام</p>
                                <h4 class="card-title">{{ App\Models\User::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-success card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="far fa-file"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">الصفحات المخصصة</p>
                                <h4 class="card-title">{{ $currentLang->pages()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-info card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa fa-list-ul"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">

                                <p class="card-category">{{ __('طلبات اليوم') }}</p>
                                <h4 class="card-title">{{ $allOrders->where('created_at', '>=', Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">




        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-warning card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">

                            <div class="numbers">
                                <p class="card-category">{{ __('مبيعات اليوم')}}</p>

                                <h4 class="card-title">

									{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}

									{{ $allOrders->where('created_at', '>=', Carbon\Carbon::today())->sum('total') }}

									{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
								</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">{{ __('العملاء') }}</p>
                                <h4 class="card-title">{{ App\Models\User::where('status',1)->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-info card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa fa-check-square"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">{{__('إجمالي المبيعات') }}</p>

                                <h4 class="card-title">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}
									{{ $allOrders->sum('total') }}
									{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-success card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa fa-envelope-square"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">{{ __('الحجوزات') }}</p>
                                <h4 class="card-title">{{ App\Models\TableBook::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-6">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">الحجوزات</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if (count($table_books) == 0)
                                        <h3 class="text-center">ليس هناك أي حجوزات</h3>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">الاسم</th>
                                                        <th scope="col">الإيميل</th>
                                                        <th scope="col">التفاصيل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($table_books as $key => $reservation)
                                                        <tr>
                                                            <td>{{ convertUtf8($reservation->name) }}</td>
                                                            <td>{{ convertUtf8($reservation->email) }}</td>
                                                            <td>
                                                                <button class="btn btn-secondary btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#detailsModal{{ $reservation->id }}"><i
                                                                        class="fas fa-eye"></i> عرض</button>
                                                            </td>
                                                        </tr>

                                                        @includeif('admin.reservations.reservation-details')
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
        </div>
        <div class="col-lg-6">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">الطلبات</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (count($orders) > 0)
                                        <div class="table-responsive table-hover table-sales">
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">رقم الطلب</th>
                                                        <th scope="col">التاريخ</th>
                                                        <th scope="col">المبلغ</th>
                                                        <th scope="col">حالة الدفع</th>
                                                        <th scope="col">التفاصيل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $order)
                                                        <tr>
                                                            <td>#{{ $order->order_number }}</td>
                                                            <td>{{ convertUtf8($order->created_at->format('d-m-Y')) }}</td>
                                                            <td>{{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                                                {{ round($order->total, 2) }}
                                                                {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                                            </td>
                                                            <td>
                                                                @if ($order->payment_status == 'Pending' || $order->payment_status == 'pending')
                                                                    <p class="badge badge-danger">
                                                                        {{ $order->payment_status }}</p>
                                                                @else
                                                                    <p class="badge badge-success">
                                                                        {{ $order->payment_status }}</p>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{ route('admin.product.details', $order->id) }}"
                                                                    target="_blank" class="btn btn-primary btn-sm "><i
                                                                        class="fas fa-eye"></i>عرض</a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <h2 class="text-center">NO ORDER FOUND</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
