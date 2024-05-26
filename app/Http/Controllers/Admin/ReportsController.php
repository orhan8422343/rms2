<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Excel;
use App\Exports\SalesReport;
use PDF;
use Illuminate\support\Str;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(isset($_GET['submit']));
        if ($request->filter) {
            $rules = [
                'from_date' => 'required',
                'to_date' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $request->session()->flash('warning', " From Date and To Date Required !");
                return back();
            }
        }


        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $type = $request->orders_from;
        $servingMethod = $request->serving_method;
        $orderStatus = $request->order_status;
        $paymentStatus = $request->payment_status;
        $completed = $request->completed;

        //pdf show this data
        Session::put('rq_from_date', Carbon::parse($fromDate));
        Session::put('rq_to_date', Carbon::parse($toDate));
        Session::put('rq_order_from', $type);
        Session::put('rq_serving_method', $servingMethod);
        Session::put('rq_order_status', $orderStatus);
        Session::put('rq_payment_status', $paymentStatus);
        Session::put('rq_completed', $completed);

        $data['orders'] = [];
        if (!empty($fromDate) && !empty($toDate)) {
            $orders = ProductOrder::when($fromDate, function ($query, $fromDate) {
                return $query->whereDate('created_at', '>=', Carbon::parse($fromDate));
            })->when($toDate, function ($query, $toDate) {
                return $query->whereDate('created_at', '<=', Carbon::parse($toDate));
            })->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->when($servingMethod, function ($query, $servingMethod) {
                return $query->where('serving_method', $servingMethod);
            })->when($orderStatus, function ($query, $orderStatus) {
                return $query->where('order_status', $orderStatus);
            })->when($paymentStatus, function ($query, $paymentStatus) {

                return $query->where('payment_status', $paymentStatus);
            })->when($completed, function ($query, $completed) {

                return $query->where('completed', $completed);
            })
                ->orderBy('id', 'DESC');
            Session::put('sales_order_report', $orders->get());

            $filterOrders = $orders->get();

            $data['orders'] = $orders->paginate(10);
            /// total orders
            $data['completed_orders'] = $filterOrders->where('completed', 'yes')->count();
            $data['earning'] = $filterOrders->where('completed', 'yes')->sum('total');
        } else {
            $data['orders'] = [];
            Session::put('sales_order_report', []);
        }

        return view('admin.product.reports.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportReport(Request $request)
    {




        $rules = [
            'fileType' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $request->session()->flash('warning', "File Type Required!");
            return back();
        }

        $fileType = $request->fileType;
        if ($fileType == "csv") {
            $orders = Session::get('sales_order_report');

            if (empty($orders) || count($orders) == 0) {
                Session::flash('warning', 'There are no orders to export');
                return back();
            }
            return Excel::download(new SalesReport($orders), 'sales-report.csv');
        }
        if ($fileType == "excel") {
            $orders = Session::get('sales_order_report');

            if (empty($orders) || count($orders) == 0) {
                Session::flash('warning', 'There are no orders to export');
                return back();
            }
            return Excel::download(new SalesReport($orders), 'sales-report.xlsx');
        }

        if ($fileType == "pdf") {
            $orders = Session::get('sales_order_report');

            if (empty($orders) || count($orders) == 0) {
                Session::flash('warning', 'There are no orders to export');
                return back();
            }

            $data['rq_from_date']              = Session::get('rq_from_date');
            $data['rq_to_date']                = Session::get('rq_to_date');
            $data['rq_order_from']             = Session::get('rq_order_from');

            $data['rq_serving_method']          = Session::get('rq_serving_method');
            $data['rq_order_status']            = Session::get('rq_order_status');
            $data['rq_payment_status']          = Session::get('rq_payment_status');
            $data['rq_completed']               = Session::get('rq_completed');


            $data['orders']  = $orders;
            $pdf = PDF::loadView('pdf.sales_report', $data)->setPaper('a3', 'landscape');
            return $pdf->download('sales-report.pdf');
            // return $pdf->stream();
        }


        Session::flash('warning', 'File Type Not Match!');
        return back();
    }
}
