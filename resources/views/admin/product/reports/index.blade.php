@extends('admin.layout')
@section('style')
    <style>
        .btnactive {
            color: rgb(61, 61, 53);
            background: white
        }

        input[type="date"] {
            padding: 7px !important
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h4 class="page-title">
            Sales Report
        </h4>
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
                <a href="#">Order Management</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">
                    Sales Report
                </a>
            </li>
        </ul>
    </div>
    @if(count($orders) > 0)
    <div class="row">
        
        <div class="col-sm-4 col-md-4 ">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                
                                <p class="card-category">Completed Orders</p>
                                <h4 class="card-title"> {{ $completed_orders ? $completed_orders : 0 }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-4 ">
            <div class="card card-stats card-info card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                {{-- <i class="flaticon-interface-6"></i> --}}
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                       
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Earning</p>
                                <h4 class="card-title">
                                    
                                 
                                  {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol :'' }} 
                                    {{ $earning ? $earning : 0}}
                                  {{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol :'' }}

                                  
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @endif


    <div class="row">
        <div class="col-lg-12">
            <p>Filter Order</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form id="" action="{{ route('admin.sales.report') }}" method="GET">
                        <div class="row no-gutters">
                            <div class="col-lg-2">
                                <div class="form-group px-0">
                                    <label for="">From Date</label>
                                    <input class="form-control" type="date" name="from_date" autocomplete="off"
                                        value="{{ request()->input('from_date') ?? '' }}" placeholder="From Date" required>

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group px-0">
                                    <label for="">To Date</label>
                                    <input class="form-control" type="date" name="to_date" autocomplete="off"
                                        value="{{ request()->input('to_date') ?? '' }}" placeholder="To Date" required>

                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group px-0">
                                    <label for="">Orders From</label>
                                    <select name="orders_from" class="form-control">
                                        <option value=""
                                            {{ empty(request()->input('orders_from')) ? 'selected' : '' }}>All</option>
                                        <option value="website"
                                            {{ request()->input('orders_from') == 'website' ? 'selected' : '' }}>Website
                                            Menu</option>
                                        <option value="qr"
                                            {{ request()->input('orders_from') == 'qr' ? 'selected' : '' }}>Qr Menu</option>
                                        <option value="pos"
                                            {{ request()->input('orders_from') == 'pos' ? 'selected' : '' }}>POS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group px-0">
                                    <label for="">Serving Method</label>
                                    <select name="serving_method" class="form-control">
                                        <option value=""
                                            {{ empty(request()->input('orders_from')) ? 'selected' : '' }}>All</option>
                                        <option value="on_table"
                                            {{ request()->input('serving_method') == 'on_table' ? 'selected' : '' }}>On
                                            Table</option>
                                        <option value="pick_up"
                                            {{ request()->input('serving_method') == 'pick_up' ? 'selected' : '' }}>Pick up
                                        </option>
                                        <option value="home_delivery"
                                            {{ request()->input('serving_method') == 'home_delivery' ? 'selected' : '' }}>
                                            Home Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group px-0">
                                    <label for="">Order</label>
                                    <select name="order_status" id="" class="form-control">
                                        <option value=""
                                            {{ empty(request()->input('order_status')) ? 'selected' : '' }}>All</option>
                                        <option value="pending"
                                            {{ request()->input('order_status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="received"
                                            {{ request()->input('order_status') == 'received' ? 'selected' : '' }}>Received
                                        </option>
                                        <option value="preparing"
                                            {{ request()->input('order_status') == 'preparing' ? 'selected' : '' }}>
                                            Preparing</option>

                                        @if (empty(request()->input('serving_method')) ||
                                                request()->input('serving_method') == 'home_delivery' ||
                                                request()->input('serving_method') == 'pick_up')
                                            <option value="ready_to_pick_up"
                                                {{ request()->input('order_status') == 'ready_to_pick_up' ? 'selected' : '' }}>
                                                Ready to pick up</option>
                                            <option value="picked_up"
                                                {{ request()->input('order_status') == 'picked_up' ? 'selected' : '' }}>
                                                Picked up</option>
                                        @endif

                                        @if (empty(request()->input('serving_method')) || request()->input('serving_method') == 'home_delivery')
                                            <option value="delivered"
                                                {{ request()->input('order_status') == 'delivered' ? 'selected' : '' }}>
                                                Delivered</option>
                                        @endif

                                        @if (empty(request()->input('serving_method')) || request()->input('serving_method') == 'on_table')
                                            <option value="ready_to_serve"
                                                {{ request()->input('order_status') == 'ready_to_serve' ? 'selected' : '' }}>
                                                Ready to Serve</option>
                                            <option value="served"
                                                {{ request()->input('order_status') == 'served' ? 'selected' : '' }}>Served
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group px-0">
                                    <label for="">Payment</label>
                                    <select name="payment_status" class="form-control">
                                        <option value="">All</option>
                                        <option value="Pending"
                                            {{ request()->input('payment_status') == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Completed"
                                            {{ request()->input('payment_status') == 'Completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group px-0">
                                    <label for="">Completed</label>
                                    <select name="completed" class="form-control">
                                        <option value="">All</option>
                                        <option value="yes"
                                            {{ request()->input('completed') == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no"
                                            {{ request()->input('completed') == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                <div class="form-group ">
                                    <label for="" style="visibility: hidden"> submit </label>
                                    <input type="submit" class="btn btn-primary" name="filter">
                                </div>
                            </div>



                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if(count($orders) > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('admin.salesReport.export') }}" method="GET">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="btn-group" role="group" aria-label="" title="File Type">
                                            <button type="button" class="btn btn-dark btnactive"
                                                value="csv">Csv</button>
                                            <button type="button" class="btn btn-dark" value="excel">Excel</button>
                                            <button type="button" class="btn btn-dark" value="pdf">Pdf</button>
                                        </div>

                                        <input type="hidden" name="fileType" value="" id="fileType">

                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm exoport">
                                            <i class="flaticon-right-arrow m-0 p-0"></i>
                                            <i class="flaticon-right-arrow m-0 p-0"></i>
                                            Export
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($orders) == 0)
                                <h3 class="text-center">NO ORDER FOUND</h3>
                            @else
                                <div id="refreshOrder">
                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order Number</th>

                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Customer Phone</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Tax</th>
                                                    <th scope="col">Shipping Charge</th>
                                                    <th scope="col">Total</th>

                                                    <th scope="col">Serving Method</th>
                                                    <th scope="col">Payment</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Completed</th>
                                                    <th scope="col">Gateway</th>
                                                    <th scope="col">Time</th>


                                                </tr>
                                            </thead>

                                            <tbody>
                                           
                                                @foreach ($orders as $key => $order)
                                                    <tr class="table-row">
                                                        <td>{{ $order->order_number }}</td>
                                                        <td> {{ convertUtf8($order->billing_fname) }}</td>
                                                        <td>{{ $order->billing_country_code }}{{ $order->billing_number }}
                                                        </td>
                                                        <td> {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                                            {{ $order->coupon }}
                                                            {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                                        </td>
                                                        <td>
                                                            {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}{{ $order->tax }}{{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}

                                                        </td>
                                                        <td>
                                                            @if (!empty($order->shipping_charge))
                                                                {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}{{ $order->shipping_charge }}{{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                                            @else
                                                                {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                                                0
                                                                {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}{{ $order->total }}{{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                                        </td>


                                                        <td class="text-capitalize">
                                                            <span
                                                                class="badge badge-dark">{{ str_replace('_', ' ', $order->serving_method) }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-dark">
                                                                {{ str_replace('_', ' ', $order->payment_status) }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-dark">
                                                                {{ str_replace('_', ' ', $order->order_status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-dark">
                                                                {{ str_replace('_', ' ', $order->completed) }}</span>
                                                        </td>
                                                        <td class="text-capitalize">
                                                            <span class="badge badge-dark">
                                                                {{ str_replace('_', ' ', $order->method) }}</span>
                                                        </td>
                                                        <td>
                                                            {{ Carbon\carbon::parse($order->created_at)->format('m-d-y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="d-inline-block mx-auto">
                            @if($orders)
                            {{$orders->appends(['from_date' => request()->input('from_date'), 'to_date' => request()->input('to_date'),'orders_from' => request()->input('orders_from'), 'serving_method' => request()->input('serving_method'), 'order_status' => request()->input('order_status'), 'payment_status' => request()->input('payment_status'), 'completed' => request()->input('completed')])->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var showMini = 0;
        minimize_sidebar = true;
        var popup;

        function closePrint() {
            if (popup) {
                popup.close();
            }
        }

        function togsidebar() {
            console.log('minimize');
            let w = window.innerWidth ||
                document.documentElement.clientWidth ||
                document.body.clientWidth;

            if (w <= 1475) {
                $(".wrapper").addClass('sidebar_minimize');
                $("button.btn.btn-toggle.toggle-sidebar").addClass('toggled');
                $("button.btn.btn-toggle.toggle-sidebar.toggled i").attr('class', 'icon-options-vertical');
                showMini = 1;
            } else if (w <= 991) {
                $(".wrapper").removeClass('sidebar_minimize');
                $("button.btn.btn-toggle.toggle-sidebar").removeClass('toggled');
                $("button.btn.btn-toggle.toggle-sidebar i").attr('class', 'icon-menu');
                showMini = 0;
            } else {
                $(".wrapper").removeClass('sidebar_minimize');
                $("button.btn.btn-toggle.toggle-sidebar").removeClass('toggled');
                $("button.btn.btn-toggle.toggle-sidebar i").attr('class', 'icon-menu');
                showMini = 0;
            }
        }

        $(document).ready(function() {
            togsidebar();

            $(".btn-toggle").on('click', function() {
                if (showMini == 1) {
                    $('.wrapper').removeClass('sidebar_minimize');
                    $(".btn-toggle").removeClass('toggled');
                    $(".btn-toggle i").attr('class', 'icon-menu');
                    showMini = 0;
                    console.log('if');
                } else {
                    console.log('else');
                    $('.wrapper').addClass('sidebar_minimize');
                    $(".btn-toggle").addClass('toggled');
                    $(".btn-toggle i").attr('class', 'icon-options-vertical');
                    showMini = 1;
                }
                console.log(showMini);
            });
        });

        $(window).resize(function() {
            togsidebar();
        });

        $(document).on('click', '.btn-group button.btn', function() {

            $("div.btn-group").find(".btnactive").removeClass("btnactive");
            $(this).addClass("btnactive");
            //click state
            const x = $("div.btn-group").find(".btnactive").val();
            $("#fileType").val(x);

        })

        //ready state
        const x = $("div.btn-group").find(".btnactive").val();
        $("#fileType").val(x);
    </script>
@endsection
