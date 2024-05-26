<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sales Invoice</title>

    <style>
        /* .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        } */

        /* @media (min-width:576px) {
            .container {
                max-width: 540px
            }
        }

        @media (min-width:768px) {
            .container {
                max-width: 720px
            }
        }

        @media (min-width:992px) {
            .container {
                max-width: 960px
            }
        }

        @media (min-width:1200px) {
            .container {
                max-width: 1140px
            }
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        @media (min-width:992px) {
            .col-lg-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-lg-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }
        } */

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-right: 1px solid #2c2d2e
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #1f2122
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .table-sm td,
        .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #1e2021
        }

        /* .table-bordered td,
        .table-bordered th {
            border: 1px solid #151718
        } */

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar
        }

        .table-responsive>.table-bordered {
            border: 0
        }

        .bg-primary {
            background-color: #898c8f !important
        }

        a.bg-primary:focus,
        a.bg-primary:hover,
        button.bg-primary:focus,
        button.bg-primary:hover {
            background-color: #0062cc !important
        }

        .text-center {
            text-align: center !important
        }
    </style>
</head>

<body>
    <div class="order-comfirmation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo text-center" style="margin-bottom: 20px; padding-top: 30px;">
                        <img src="{{ asset('assets/front/img/' . $bs->logo) }}" alt="">
                    </div>
                    <p style="padding: 0px; margin:0px; color:#181313;text-align:center;margin-bottom:0px">
                        <span style="font-weight:bold;"><u>Searching:<u></span>
                        @if ($rq_from_date)
                            <span style="font-weight:bold">From:</span>
                            {{ Carbon\carbon::parse($rq_from_date)->format('m-d-y') }},
                        @endif
                        @if ($rq_to_date)
                            <span style="font-weight:bold">To: </span>
                            {{ Carbon\carbon::parse($rq_to_date)->format('m-d-y') }},
                        @endif
                        @if ($rq_order_from)
                            <span style="font-weight:bold">Order From: </span>
                            {{ $rq_order_from }},
                        @else
                            <span style="font-weight:bold">Order From:</span>
                            All,
                        @endif

                        @if ($rq_serving_method)
                            <span style="font-weight:bold">Serving Method: </span>
                            {{ $rq_serving_method }},
                        @else
                            <span style="font-weight:bold">Serving Method:</span>
                            All,
                        @endif

                        @if ($rq_order_status)
                            <span style="font-weight:bold">Order Status: </span>
                            {{ $rq_order_status }},
                        @else
                            <span style="font-weight:bold">Order Status:</span>
                            All,
                        @endif

                        @if ($rq_payment_status)
                            <span style="font-weight:bold">Payment Status: </span>
                            {{ $rq_payment_status }},
                        @else
                            <span style="font-weight:bold">Payment Status:</span>
                            All,
                        @endif

                        @if ($rq_completed)
                            <span style="font-weight:bold">Completed: </span>
                            {{ $rq_completed }}
                        @else
                            <span style="font-weight:bold">Completed:</span>
                            All
                        @endif

                    </p>
                    <div class="confirmation-message bg-primary"
                        style="padding: 0px;margin-bottom: 20px; margin-top: 0px">
                        <h2 class="text-center"><strong style="color: white; ">{{ __('Sales Report') }}</strong></h2>
                    </div>

                    <div class="row">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>

                                    <th scope="col">Order Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Tax</th>
                                    <th scope="col">Shipping Charge</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Serving Method</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Completed</th>
                                    <th scope="col">Gateway </th>
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
            </div>

        </div>
</body>

</html>
