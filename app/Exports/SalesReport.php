<?php

namespace App\Exports;

use App\Models\ProductOrder;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;



class SalesReport implements FromCollection,WithHeadings, WithMapping
{
  

    public $orders;

    public function __construct($orders)
    {
        
        $this->orders = $orders;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
    
        return $this->orders;
    }

    public function map($order): array
    {
     

        return [
            
            $order->order_number,
            $order->billing_fname,
            $order->billing_country_code . $order->billing_number,

            ($order->currency_symbol_position == 'left' ? $order->currency_symbol : '')  .' '.  $order->coupon . ($order->currency_symbol_position == 'right' ? $order->currency_symbol. ' ' : ''),
            ($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''). $order->tax . ($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''),
            !empty($order->shipping_charge) ?
                ($order->currency_symbol_position == 'left' ? $order->currency_symbol : '') . $order->shipping_charge . ($order->currency_symbol_position == 'right' ? $order->currency_symbol : '' ) :
                ($order->currency_symbol_position == 'left' ? $order->currency_symbol : '').
                0 .
                ($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''),
            
            ($order->currency_symbol_position == 'left' ? $order->currency_symbol : '' ). $order->total . ($order->currency_symbol_position == 'right' ? $order->currency_symbol : '' ),

            str_replace('_', ' ', $order->serving_method),

            str_replace('_', ' ', $order->payment_status),
            str_replace('_', ' ', $order->order_status),
            str_replace('_', ' ', $order->completed),
            str_replace('_', ' ', $order->method),
             $order->created_at
        ];
      

    }

    public function headings(): array
    {
        return [
            'Order Number', 'Name', 'Phone', 'Discount', 'Tax', 'Shipping Charge', 'Total', 'Serving Method', 'Payment','Status','completed','Gateway','Time',
        ];
    }
}
