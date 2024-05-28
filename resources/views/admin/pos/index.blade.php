@extends('admin.layout')

@section('sidebar', 'overlay-sidebar')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/calculator.min.css')}}">
@endsection

@section('content')

<div class="row" id="outsidePrintScreen">
    <div class="col-md-12">

        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-12 px-0">
                        <form>
                            <div class="form-group pt-0">
                                <input name="search" type="text" class="form-control" placeholder="البحث">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="posCatItems" style="display: block;">
                    @includeIf('admin.pos.partials.cats-items')
                </div>
                <div id="posItems" style="display: none;">
                    @includeIf('admin.pos.partials.items')
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body px-2">
                        <form id="orderForm" action="{{route('admin.pos.placeOrder')}}" method="POST">
                            @csrf
                            <div class="form-group p-0 pb-2">
                                <div class="ui-widget" style='font-family: "Noto Kufi Arabic", sans-serif !important;'>
                                    <label for="">رقم الزبون</label>
                                    <input class="form-control" type="text" name="customer_phone" placeholder="رقم الهاتف" value="{{old('customer_phone')}}" onchange="loadCustomerName(this.value)">
                                    {{-- <p class="text-warning mb-0">Use <strong>Country Code</strong> in phone number</p> --}}
                                </div>
                            </div>
                            <div class="form-group p-0 pb-2">
                                <div class="ui-widget" style='font-family: "Noto Kufi Arabic", sans-serif !important;'>
                                    <label for="">اسم الزبون</label>
                                    <input class="form-control" name="customer_name" type="text" placeholder="الاسم" value="{{old('customer_name')}}" disabled>
                                    <small class="text-warning">قم بإضافة رقم الهاتف أولًا</small>
                                </div>
                            </div>
                            <div class="form-group p-0 pb-2">
                                <label for="">طريقة التقديم</label>
                                <select class="form-control" name="serving_method" required>
                                    @foreach ($smethods as $smethod)
                                        <option value="{{$smethod->value}}" {{$smethod->value == old('serving_method') ? 'selected' : ''}}>{{$smethod->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-0 pb-2">
                                <label for="">طريقة الدفع</label>
                                <select class="form-control select" name="payment_method">
                                    <option value="" selected disabled>اختيار طريقة الدفع</option>
                                    @foreach ($pmethods as $pmethod)
                                        <option value="{{$pmethod->name}}" {{$pmethod->name == old('payment_method') ? 'selected' : ''}}>{{$pmethod->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-0 pb-2">
                                <label for="">حالة الدفع</label>
                                <select class="form-control" name="payment_status" required>
                                    <option value="Pending" {{"Pending" == old('payment_status') ? 'selected' : ''}}>معلقة</option>
                                    <option value="Completed" {{"Completed" == old('payment_status') ? 'selected' : ''}}>غير مكتملة</option>
                                </select>
                            </div>
                            <div id="on_table" class="d-none extra-fields">
                                <div class="form-group p-0 pb-2">
                                    <label for="">رقم الطاولة</label>
                                    <select class="form-control select" name="table_no">
                                        <option value="" selected disabled>اختيار رقم الطاولة</option>
                                        @foreach ($tables as $table)
                                            <option value="{{$table->table_no}}" {{$table->table_no == old('table_no') ? 'selected' : ''}}>Table - {{$table->table_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="pick_up" class="d-none extra-fields">
                                <div class="form-group p-0 pb-2">
                                    <label for="">Pickup Date</label>
                                    <input name="pick_up_date" type="text" class="form-control datepicker" placeholder="Pickup Date" autocomplete="off">
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <label for="">Pickup Time</label>
                                    <input name="pick_up_time" type="text" class="form-control timepicker" placeholder="Pickup Time" autocomplete="off">
                                </div>
                            </div>

                            <div id="home_delivery" class="d-none extra-fields">
                                @if ($be->delivery_date_time_status == 1)
                                    <div class="form-group p-0 pb-2">
                                        <label>Delivery Date</label>
                                        <div class="field-input cross {{!empty(old('delivery_date')) ? 'cross-show' : ''}}">
                                            <input class="form-control delivery-datepicker" type="text" name="delivery_date" autocomplete="off" value="{{old('delivery_date')}}">
                                            <i class="far fa-times-circle"></i>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 pb-2">
                                        <label>Delivery Time</label>
                                        <select id="deliveryTime" class="form-control" name="delivery_time" disabled>
                                            <option value="" selected disabled>Select a time frame</option>
                                        </select>
                                    </div>
                                @endif

                                <div id="shippingPostCharges">
                                    @if ($bs->postal_code == 0)

                                        @if (count($scharges) > 0)
                                            <div id="shippingCharges" class="form-group p-0 pb-2">
                                                <label>{{__('Shipping Charges')}}</label>
                                                @foreach ($scharges as $scharge)
                                                    <div class="form-check p-0 pl-4">
                                                        <input class="form-check-input" type="radio" data="{{!empty($scharge->free_delivery_amount) && (posCartSubTotal() >= $scharge->free_delivery_amount) ? 0 : $scharge->charge}}" name="shipping_charge" id="scharge{{$scharge->id}}" value="{{$scharge->id}}" {{$loop->first ? 'checked' : ''}} data-free_delivery_amount="{{$scharge->free_delivery_amount}}">
                                                        <label class="form-check-label mb-0" for="scharge{{$scharge->id}}">{{$scharge->title}}</label>
                                                        +
                                                        <strong>
                                                            {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$scharge->charge}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                        </strong>
                                                    </div>

                                                    @if (!empty($scharge->free_delivery_amount))
                                                        <p class="mb-0 pl-2">(@lang('Free Delivery for Orders over')
                                                            {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$scharge->free_delivery_amount - 1}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}})</p>
                                                    @endif
                                                    <p class="mb-0 text-warning pl-2"><small>{{$scharge->text}}</small></p>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div class="form-group p-0 pb-2">
                                            <label>{{__('Postal Code')}} (Delivery Area)</label>
                                            <select name="postal_code" class="select2 form-control">
                                                @foreach ($postcodes as $postcode)
                                                    <option value="{{$postcode->id}}" data="{{$postcode->charge}}" data-free_delivery_amount="{{$postcode->free_delivery_amount}}">
                                                        @if (!empty($postcode->title))
                                                            {{$postcode->title}} -
                                                        @endif
                                                        {{$postcode->postcode}}

                                                        ({{__('Delivery Charge')}} - {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$postcode->charge}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                        @if (!empty($postcode->free_delivery_amount))
                                                            ,  @lang('Free Delivery for Orders over')
                                                            {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$postcode->free_delivery_amount - 1}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                        @endif
                                                        )

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer text-center">
                        <button form="orderForm" class="btn btn-success" type="submit">إضافة الطلب</button>
                        {{-- @if ($onTable->pos == 1)
                            <p class="mb-0 text-warning">Token No. print option (for '{{$onTable->name}}' orders) will be shown after placing order.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="text-white">الطلبات</h4>
                            </div>
                        </div>


                        <div id="divRefresh">
                            @if (empty($cart))
                            <div class="text-center py-5 bg-light mt-4">
                                <h4>لم يتم إضافة أي طلب</h4>
                            </div>
                            @else
                            <div id="cartTable">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-white">الطلب</th>
                                            <th scope="col" class="text-white">الكمية</th>
                                            <th scope="col" class="text-white">السعر ({{$be->base_currency_symbol}})</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                        @php
                                        $id = $item["id"];
                                        $product = App\Models\Product::findOrFail($id);
                                        @endphp
                                        <tr class="cart-item">
                                            <td width="45%" class="item">
                                                <h5 class="text-white">{{convertUtf8($item['name'])}}</h5>
                                                @if (!empty($item["variations"]))
                                                    <p><strong class="text-white">{{__("Variation")}}:</strong> <br>
                                                        @php
                                                            $variations = $item["variations"];
                                                        @endphp
                                                        @foreach ($variations as $vKey => $variation)
                                                            <span class="text-capitalize">{{str_replace("_"," ",$vKey)}}:</span> {{$variation["name"]}}
                                                            @if (!$loop->last)
                                                            ,
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                @endif

                                                @if (!empty($item["addons"]))
                                                <p>
                                                    <strong class="text-white">{{__("Add On's")}}:</strong>
                                                    @php
                                                    $addons = $item["addons"];
                                                    @endphp
                                                    @foreach ($addons as $addon)
                                                    {{$addon["name"]}}
                                                    @if (!$loop->last)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                </p>
                                                @endif
                                                <i class="fas fa-times text-danger item-remove" data-href="{{route('admin.cart.item.remove',$key)}}"></i>
                                            </td>
                                            <td width="45%" style="padding-left: 0px !important;padding-right: 0px !important;">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text sub" data-key="{{$key}}">
                                                            <i class="fas fa-minus"></i>
                                                        </span>
                                                    </div>
                                                    <input name="quantity" type="number" class="form-control" value="{{$item['qty']}}" data-key="{{$key}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text add" data-key="{{$key}}">
                                                            <i class="fas fa-plus"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="10%">
                                                {{$item['total']}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <ul class="list-group">
                                {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Subtotal
                                    <span>
                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                        <span id="subtotal">{{posCartSubTotal()}}</span>
                                        {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tax
                                    <span>
                                        +
                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                        <span id="tax">{{posTax()}}</span>
                                        {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Shipping Charge
                                    <span>
                                        +
                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                        <span id="shipping">{{posShipping()}}</span>
                                        {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                    </span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-primary text-white">
                                    <strong>الإجمالي</strong>
                                    <span>
                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                        <span class="grandTotal">{{posCartSubTotal() + posTax() + posShipping()}}</span>
                                        {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                    </span>
                                </li>
                            </ul>

                            @endif
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <div class="row no-gutters">
                            <div class="col-lg-4">
                                <button id="calcModalBtn" type="button" class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Calculator">
                                    <i class="fas fa-calculator"></i> الحاسبة
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-success btn-block" id="printBtn">طباعة الفاتورة</button>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-danger btn-block" id="clearCartBtn">حذف السلة</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Calculator Modal --}}
<div class="modal fade" id="calcModal" tabindex="-1" role="dialog" aria-labelledby="calcModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Calculator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">


                    <form>
                        <input readonly id="display1" type="text" class="form-control-lg text-right">
                        <input readonly id="display2" type="text" class="form-control-lg text-right">
                    </form>

                    <div class="d-flex justify-content-between button-row">
                        <button id="left-parenthesis" type="button" class="operator-group">&#40;</button>
                        <button id="right-parenthesis" type="button" class="operator-group">&#41;</button>
                        <button id="square-root" type="button" class="operator-group">&#8730;</button>
                        <button id="square" type="button" class="operator-group">&#120;&#178;</button>
                    </div>

                    <div class="d-flex justify-content-between button-row">
                        <button id="clear" type="button">&#67;</button>
                        <button id="backspace" type="button">&#9003;</button>
                        <button id="ans" type="button" class="operand-group">&#65;&#110;&#115;</button>
                        <button id="divide" type="button" class="operator-group">&#247;</button>
                    </div>


                    <div class="d-flex justify-content-between button-row">
                        <button id="seven" type="button" class="operand-group">&#55;</button>
                        <button id="eight" type="button" class="operand-group">&#56;</button>
                        <button id="nine" type="button" class="operand-group">&#57;</button>
                        <button id="multiply" type="button" class="operator-group">&#215;</button>
                    </div>


                    <div class="d-flex justify-content-between button-row">
                        <button id="four" type="button" class="operand-group">&#52;</button>
                        <button id="five" type="button" class="operand-group">&#53;</button>
                        <button id="six" type="button" class="operand-group">&#54;</button>
                        <button id="subtract" type="button" class="operator-group">&#8722;</button>
                    </div>


                    <div class="d-flex justify-content-between button-row">
                        <button id="one" type="button" class="operand-group">&#49;</button>
                        <button id="two" type="button" class="operand-group">&#50;</button>
                        <button id="three" type="button" class="operand-group">&#51;</button>
                        <button id="add" type="button" class="operator-group">&#43;</button>
                    </div>

                    <!-- Rounded switch -->
                    <label class="switch" style="display: none;">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                    <div class="d-flex justify-content-between button-row">
                        <button id="percentage" type="button" class="operand-group">
                            {{-- &#37; --}}

                        </button>
                        <button id="zero" type="button" class="operand-group">&#48;</button>
                        <button id="decimal" type="button" class="operand-group">&#46;</button>
                        <button id="equal" type="button">&#61;</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

    {{-- Variation Modal Starts --}}
    @includeIf('front.partials.variation-modal')
    {{-- Variation Modal Ends --}}

    <div id="customerCopy">
        <iframe id="customerReceipt" src="{{url("admin/print/customer-copy")}}" style="display:none;"></iframe>
    </div>
    <div id="kitchenCopy">
        <iframe id="kitchenReceipt" src="{{url("admin/print/kitchen-copy")}}" style="display:none;"></iframe>
    </div>
    <div id="tokenNo">
        <iframe id="tokenNoPrintable" src="{{url("admin/print/token-no")}}" style="display:none;"></iframe>
    </div>
@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/3.17.0/math.min.js"></script>
<script src="{{asset('assets/admin/js/plugin/calculator/calculator.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugin/printthis.min.js')}}"></script>

@if (Session::has('success') && $onTable->pos == 1 && Session::has('previous_serving_method') && Session::get('previous_serving_method') == 'on_table')
<script>
    var tokenFrame = document.getElementById("tokenNoPrintable");
    tokenFrame.focus();
    tokenFrame.contentWindow.print();
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function fetchOrders() {
    $.ajax({
        url: "{{ route('admin.product.orders') }}",
        type: "GET",
        success: function(data) {
            $('#orders-table').html(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>
{{-- Blade syntax for the JavaScript code --}}
<script>
    $(document).ready(function() {
        // Function to load extra fields based on selected serving method
        function loadExtraFields(val) {
            $(".extra-fields").removeClass('d-block').addClass('d-none').attr('disabled', true);
            $("#" + val).removeClass("d-none").addClass("d-block").removeAttr('disabled');
        }

        // Function to set shipping charge based on serving method
        function setShippingCharge() {
            var servingMethod = $("select[name='serving_method']").val();
            var charge = 0.00;

            if (servingMethod == 'home_delivery') {
                @if ($bs->postal_code == 0)
                    var $checkedIn = $("input[name='shipping_charge']:checked");
                    charge = $checkedIn.length > 0 ? parseFloat($checkedIn.attr('data')) : 0;
                    if ($checkedIn.data('free_delivery_amount') && (parseFloat($("#subtotal").text()) >= parseFloat($checkedIn.data('free_delivery_amount')))) {
                        charge = 0;
                    }
                @else
                    var $selectedOpt = $("select[name='postal_code']").children('option:selected');
                    charge = $selectedOpt.data('free_delivery_amount') && (parseFloat($("#subtotal").text()) >= parseFloat($selectedOpt.data('free_delivery_amount'))) ? 0 : parseFloat($selectedOpt.attr('data'));
                @endif
            }

            $.get("{{route('admin.pos.shippingCharge')}}", {
                shipping_charge: charge,
                serving_method: servingMethod
            }, function(data) {
                $("#customerCopy").load(location.href + " #customerCopy");
                $("#divRefresh").load(location.href + " #divRefresh", function() {
                    $(".request-loader").removeClass('show');
                });
            });
        }

        // Load extra fields based on initially selected serving method
        loadExtraFields($("select[name='serving_method']").val());

        // Event listener for serving method change
        $("select[name='serving_method']").on('change', function() {
            loadExtraFields($(this).val());
            setShippingCharge();
        });

        // Event listener for clearing the cart
        $(document).on("click", "#clearCartBtn", function() {
            $(".request-loader").addClass("show");
            $.get("{{route('admin.cart.clear')}}", function(data) {
                if(data == "success") {
                    location.reload();
                }
            });
        });

        // Event listener for input search
        $(document).on("input", "input[name='search']", function() {
            var keyword = $(this).val().toLowerCase();
            if(keyword.length > 0) {
                $("#posCatItems").hide();
                $("#posItems").show();
                $(".pos-item").hide().each(function() {
                    var title = $(this).data('title').toLowerCase();
                    if(title.indexOf(keyword) > -1) {
                        $(this).show();
                    }
                });
            } else {
                $("#posItems").hide();
                $("#posCatItems").show();
            }
        });

        // Event listener for print button
        $("#printBtn").click(function() {
            var customerFrame = document.getElementById("customerReceipt");
            customerFrame.focus();
            customerFrame.contentWindow.print();

            var kitchenFrame = document.getElementById("kitchenReceipt");
            kitchenFrame.focus();
            kitchenFrame.contentWindow.print();
        });

        // Event listener for modal button
        $("#calcModalBtn").on('click', function() {
            $("#calcModal").modal('show');
        });

        // Event listener for loading customer name
        $(document).on("input", "input[name='customer_phone']", function() {
            loadCustomerName($(this).val());
        });
    });

    // Function to load customer name based on phone number
    function loadCustomerName(phone) {
        if(phone.length > 0) {
            $(".request-loader").addClass('show');
            $("input[name='customer_name']").removeAttr('disabled');
            $.get("load/" + phone + "/customer-name", function(data) {
                $(".request-loader").removeClass('show');
                $("input[name='customer_name']").val(data.name);
            });
        } else {
            $("input[name='customer_name']").val('').attr('disabled', true);
        }
    }

    // Function to load time frames based on selected date
    function loadTimeFrames(date, time) {
        if (date.length > 0) {
            $.get(
                "{{route('front.timeframes')}}",
                { date: date },
                function(data) {
                    console.log('time frames', data);
                    var options = `<option value="" selected disabled>Select a Time Frame</option>`;
                    if (data.status == 'success') {
                        $("#deliveryTime").removeAttr('disabled');
                        var timeframes = data.timeframes;
                        for (var i = 0; i < timeframes.length; i++) {
                            options += `<option value="${timeframes[i].id}" ${time == timeframes[i].id ? 'selected' : ''}>${timeframes[i].start_time} - ${timeframes[i].end_time}</option>`;
                        }
                    } else {
                        options += `<option value="">No time frames available</option>`;
                        $("#deliveryTime").attr('disabled', true);
                    }
                    $("#deliveryTime").html(options);
                }
            );
        } else {
            $("#deliveryTime").attr('disabled', true).html('<option value="" selected disabled>Select a Date First</option>');
        }
    }
</script>
{{-- END: Home delivery extra fields javascript --}}

<script>
    var textPosition = "{{$be->base_currency_text_position}}";
    var currText = "{{$be->base_currency_text}}";
    var posAudio = new Audio("{{asset('assets/front/files/beep-07.mp3')}}");
    var select = "{{__('Select')}}";
</script>
<!--====== Cart js ======-->
<script src="{{asset('assets/admin/js/cart.js')}}"></script>
@endsection
