<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Mail\OrderConfirmed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderCanceled;
use App\Mail\OrderDelivery;
use App\Mail\OrderShipped;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(){
        $data['title'] = 'Order List';
        $data['orders'] = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index',$data);
    }

    public function show($id){
        $data['company_data'] = getSetting();
        $data['title'] = 'Order Details';
        $data['order'] = Order::with('orderDetails.product')->find($id);

        return view('admin.order.view',$data);
    }

    public function statusUpdate(Request $request, $id)
    {
        try {


            $settings = getSetting();
            $order = Order::findOrFail($id);


            if ($request->order_status == 5) {
                // Cancel order
                $order->update([
                    'order_status' => 5,
                    'canceled_by' => '2',
                    'canceled_at' => now(),
                ]);

               if ($settings->email_enable ==  1) {
                Mail::to($order->customer_email)->send(new OrderCanceled($order));
            }

            } elseif ($request->order_status == 1) {

                $order->update([
                    'order_status' => 1,
                ]);
                if ($settings->email_enable ==  1) {
                Mail::to($order->customer_email)->send(new OrderConfirmed($order));
                }
            } elseif ($request->order_status == 3) {
                $order->update([
                    'order_status' => 3,
                ]);
                if ($settings->email_enable ==  1) {
                Mail::to($order->customer_email)->send(new OrderShipped($order));
                }
            } elseif ($request->order_status == 4) {
                if($order->payment_method == 'cod'){
                    $order->update([
                        'order_status' => 4,
                        'payment_status' => 1,
                    ]);
                }
                if ($settings->email_enable ==  1) {
                Mail::to($order->customer_email)->send(new OrderDelivery($order));
                }
            }

            Toastr::success(__('Order status updated successfully.'), __('Success'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            Toastr::error(__('There was an error updating the order status.'), __('Error'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }


}
