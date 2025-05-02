<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Setting;
use Stripe\Climate\Order;
use App\Mail\WellcomeMail;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\GuestWelcomeMail;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use App\Http\Controllers\Controller;
use App\Models\Order as ModelsOrder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotificationMail;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class PaymentController extends Controller
{
    public function processOrder(Request $request)
    {
        // Validate input data
        $rules = [
            'f_name' => 'required|string|max:255|regex:/^\S(.*\S)?$/',  // First name validation
            'l_name' => 'required|string|max:255|regex:/^\S(.*\S)?$/',  // Last name validation,
            'email' => 'required|email|max:255',
            'zipcode' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'country_id' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'payment_method' => 'required',  // Ensure payment method is selected
            'company_name' => 'nullable',
            'password' => 'required_if:create_account,1'
        ];

        // Apply the unique email validation rule only if create_account is 1
        if ($request->create_account == '1') {
            $rules['email'] .= '|unique:users,email';
        }

        // Validate the request data
        $request->validate($rules);

        // Calculate order total
        $subtotal = $request->subtotal;
        $coupon = Session::get('applied_coupon');
        if ($request->payment_method === 'sslcommerz') {
            return $this->processSslCommerzPayment($request, $subtotal);
        }
        if ($request->payment_method === 'stripe') {

            $paymentSuccess = $this->processStripePayment($request, $subtotal);

            if ($paymentSuccess) {
                return redirect($paymentSuccess);
            } else {
                // If payment fails, redirect back with an error message
                return redirect()->back()->with('error', 'Payment failed. Please try again.');
            }
        }

        // If payment method is COD (Cash on Delivery), directly store the order without processing payment
        if ($request->payment_method === 'cod') {

            // Directly store the order data in the database
            $order = $this->storeOrderData($request, $subtotal);

            // Redirect to COD success page or order confirmation
            return redirect()->route('order.success');
        }

        // If payment method is invalid
        return redirect()->back()->with('error', 'Invalid payment method selected.');
    }



    // Example method to process Stripe payment
    private function processStripePayment($request, $subtotal)
    {

        $config = DB::table('config')->select('config_value')->whereIn('id', ['10', '11'])->get()->pluck('config_value');
        $stripeSecretKey = $config[1];

        $stripe     = new \Stripe\StripeClient($stripeSecretKey);
        $lineItems  = [];
        $cartItems = Session::get('cart', []);

        // $calculatedSubtotal = $subtotal;


        $taxRate = $request->tax_rate ?? 0;
        $shippingFee = $request->shipping_fee ?? 0;
        $coupon = Session::get('applied_coupon');
        $couponDiscount = $coupon['discount'] ?? 0;
        $taxAmount = $subtotal * ($taxRate / 100);
        $grandTotal = round($subtotal + $shippingFee + $taxAmount - $couponDiscount, 2);
        $grandTotalInCents = (int)($grandTotal * 100);

        $response = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => 'Shop', // You might want to dynamically set this
                    ],
                    'unit_amount' => $grandTotalInCents,
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',
            'success_url' => route('stripe.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('order.cancel'),

            // Move metadata here
            'metadata' => [
                'create_account' => $request->create_account,
                'customer_name'  => $request->f_name . ' ' . $request->l_name,
                'customer_email' => $request->email,
                'customer_password' => $request->password,
                'customer_phone' => $request->phone,
                'street'         => $request->street,
                'zipcode'        => $request->zipcode,
                'country_id'     => $request->country_id,
                'state_id'       => $request->state_id,
                'city'           => $request->city,
                'note'           => $request->note,
                'shipping_fee'   => $shippingFee,
                'tax_rate'       => $request->tax_rate,
                'tax'            => $taxAmount,
                'subtotal'       => $subtotal,
                'company_name'   => $request->company_name,
                'address'        => $request->address,
                'apartment_suite'=> $request->apartment_suite,


            ],
        ]);

        //  dd($response);

        if (isset($response->id) && $response->id != '') {
            // dd($response->url);
            return $response->url;
        } else {
            // OrderMail($data);
            return null;
        }
    }

    public function stripePaymentSuccess(Request $request)
    {
        $mailConfig = Setting::first()->email_enable;
        $config = DB::table('config')->select('config_value')->whereIn('id', ['10', '11'])->get()->pluck('config_value');

        if ($request->session_id) {

            $stripe = new \Stripe\StripeClient($config[1]);
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($response && $response->id) {
                $metadata = $response->metadata;

                $subtotal        = (float) $metadata->subtotal;
                $tax_rate        = (float) $metadata->tax_rate;
                $shipping_fee    = (float) $metadata->shipping_fee;
                $tax_amount      = $subtotal * ($tax_rate / 100);

                $coupon          = Session::get('applied_coupon');
                $coupon_discount = $coupon['discount'] ?? 0;
                $grand_total     = $subtotal + $shipping_fee + $tax_amount - $coupon_discount;

                $orderNumber     = $this->generateUniqueOrderNumber();

                $order                       = new ModelsOrder();
                $order->order_number         = $orderNumber;
                $order->user_id              = auth()->id();
                $order->customer_name        = $metadata->customer_name;
                $order->company_name         = $metadata->company_name ?? null;
                $order->address              = $metadata->address ?? null;
                $order->apartment_suite      = $metadata->apartment_suite ?? null;
                $order->customer_email       = $metadata->customer_email;
                $order->customer_phone       = $metadata->customer_phone;
                $order->street               = $metadata->street;
                $order->zipcode              = $metadata->zipcode;
                $order->country_id           = $metadata->country_id;
                $order->city                 = $metadata->city;
                $order->state_id             = $metadata->state_id;
                $order->note                 = $metadata->note;
                $order->shipping_charge      = $shipping_fee;
                $order->vat                  = $tax_amount;
                $order->coupon_id            = $coupon['coupon_id'] ?? null;
                $order->coupon_discount      = $coupon_discount;
                $order->total_price          = $subtotal;
                $order->grand_total          = $grand_total;
                $order->order_date           = now()->format('Y-m-d');
                $order->payment_method       = 'stripe';
                $order->payment_status       = 1;
                $order->order_status         = 0;

                if($metadata->create_account == '1'){
                    $order->guest = 1;
                    $data           = new User();
                    $data->name     = $metadata->customer_name;
                    $data->email    = $metadata->customer_email;
                    $user_password = $metadata->customer_password;
                    $data->password = bcrypt($metadata->customer_password);
                    $max_code = User::max('user_code');
                    if($max_code){
                        $data->user_code = $max_code+1;
                    }
                    $data->user_code = 1001;
                    $data->username = rand();
                    $data->save();
                    Mail::to($data->email)->send(new GuestWelcomeMail($data, $user_password));
                    $order->user_id              = $data->id;
                }
                $order->save();

                // Save cart items
                $cartItems = Session::get('cart', []);
                foreach ($cartItems as $cartItem) {
                    $orderdetails                   = new OrderDetail();
                    $orderdetails->order_id         = $order->id;
                    $orderdetails->user_id          = auth()->id();
                    $orderdetails->product_id       = $cartItem['product_id'];
                    $orderdetails->product_title    = $cartItem['title'];
                    $orderdetails->product_price    = $cartItem['price'];
                    $orderdetails->product_quantity = $cartItem['quantity'];
                    if($metadata->create_account == '1'){
                        $orderdetails->user_id    = $data->id;
                    }
                    $orderdetails->save();

                    // Reduce product stock
                    $product = Product::find($cartItem['product_id']);
                    if ($product) {
                        $product->stock -= $cartItem['quantity'];
                        $product->save();
                    }
                }

                // Update coupon usage
                if ($coupon && isset($coupon['coupon_id'])) {
                    $couponData = Coupon::find($coupon['coupon_id']);
                    if ($couponData) {
                        $couponData->used_count -= 1;
                        $couponData->save();
                    }
                }

                // Email notifications
                if ($mailConfig == 1) {
                    $orderItems = OrderDetail::where('order_id', $order->id)->get();
                    Mail::to(auth()->user()->email ?? $metadata->customer_email)->send(new OrderConfirmationMail($order, $orderItems));
                    $adminEmail = Setting::first()->email;
                    Mail::to($adminEmail)->send(new NewOrderNotificationMail($order, $orderItems));
                }

                return redirect()->route('order.success');
            } else {
                Toastr::error('Payment Failed');
                return redirect()->route('user.dashboard');
            }
        } else {
            Toastr::error('Session expired');
            return redirect()->route('user.dashboard');
        }
    }
    // Method to store order data in the database
    private function storeOrderData($request, $subtotal)
    {
        //  dd($request->all());

        $mailConfig = Setting::first()->email_enable;

        $coupon = Session::get('applied_coupon');
        $tax_rate        = $request->tax_rate;
        $shipping_fee    = $request->shipping_fee;
        $tax_amount      = $subtotal * ($tax_rate / 100);
        $coupon_discount = $coupon['discount'] ?? 0;
        $grand_total     = $subtotal + $shipping_fee + $tax_amount - $coupon_discount;

        $orderNumber = $this->generateUniqueOrderNumber();
        // $coupon      = Session::get('applied_coupon');

        $order                  = new ModelsOrder();
        $order->user_id         = auth()->id();
        $order->order_number    = $orderNumber;
        $order->customer_name   = $request->f_name . ' ' . $request->l_name;
        $order->company_name    = $request->company_name;
        $order->address         = $request->address;
        $order->apartment_suite = $request->apartment_suite;
        $order->customer_email  = $request->email;
        $order->customer_phone  = $request->phone;
        $order->street          = $request->street;
        $order->zipcode         = $request->zipcode;
        $order->country_id      = $request->country_id;
        $order->city            = $request->city;
        $order->state_id        = $request->state_id;
        $order->note            = $request->note;
        $order->shipping_charge = $shipping_fee;
        $order->vat             = $tax_amount;
        $order->coupon_id       = $coupon ? $coupon['coupon_id'] : null;
        $order->coupon_discount = $coupon ? $coupon['discount'] : 0;
        $order->total_price     = $request->subtotal;
        $order->grand_total     =  $grand_total;
        $order->order_date      = now()->format('Y-m-d');
        $order->payment_method  = $request->payment_method;
        $order->payment_status = 0;
        $order->order_status = 0;

        if($request->create_account == '1'){
            $order->guest   = 1;
            $data           = new User();
            $data->name     = $request->f_name . ' ' . $request->l_name;
            $data->email    = $request->email;
            $user_password       = $request->password;
            $data->password = bcrypt($request->password);
            $max_code = User::max('user_code');
            if($max_code){
                $data->user_code = $max_code+1;
            }
            $data->user_code = 1001;
            $data->username  = rand();
            $data->save();
            Mail::to($data->email)->send(new GuestWelcomeMail($data, $user_password));
            $order->user_id  = $data->id;
        }

        $order->save();

        $cartItems = Session::get('cart', []);
        foreach ($cartItems as $cartItem) {
            $orderdetails                   = new OrderDetail();
            $orderdetails->order_id         = $order->id;
            $orderdetails->user_id          = auth()->user()->id ?? null;
            $orderdetails->product_id       = $cartItem['product_id'];
            $orderdetails->product_title    = $cartItem['title'];
            $orderdetails->product_price    = $cartItem['price'];
            $orderdetails->product_quantity = $cartItem['quantity'];
            if($request->create_account == '1'){
                $orderdetails->user_id    = $data->id;
            }
            $orderdetails->save();

            $product         = Product::find($cartItem['product_id']);
            $product->stock -= $cartItem['quantity'];
            $product->save();
        }

        if (is_array($coupon) && isset($coupon['coupon_id']) && $coupon['coupon_id'] != null) {
            $couponData = Coupon::find($coupon['coupon_id']);

            if ($couponData) { // Ensure that coupon data exists
                $couponData->used_count -= 1;
                $couponData->save();
            }
        }

        if ($mailConfig == 1) {
            $orderItems = OrderDetail::where('order_id', $order->id)->get();
            Mail::to(auth()->user()->email ?? $request->email)->send(new OrderConfirmationMail($order, $orderItems));


            $adminEmail = Setting::first()->email;
            Mail::to($adminEmail)->send(new NewOrderNotificationMail($order, $orderItems));
        }
    }

    private function generateUniqueOrderNumber()
    {
        do {
            $orderNumber = rand(100000, 999999);  // Generate a random 6-digit number
        } while (ModelsOrder::where('order_number', $orderNumber)->exists());  // Check if it already exists in the database

        return $orderNumber;
    }

    public function StripeSuccess() //Eta success chilo , eta thik kore niyen bhai
    {
        Session::forget('cart');
        Session::forget('applied_coupon');
        // Handle success (maybe send a confirmation email or show order details)
        Toastr::success('Order created successfully', 'Success');
        if(Auth::check()){
            return redirect()->route('user.dashboard');
        }else{
            return redirect()->route('home');
        }
    }

    public function paymentCancel()
    {

        Session::forget('cart');
        Session::forget('applied_coupon');

        Toastr::error('Order cancelled', 'Error');
        if(Auth::check()){
            return redirect()->route('user.dashboard');
        }else{
            return redirect()->route('home');
        }
    }


    private function processSslCommerzPayment($request, $subtotal)
    {
        // Calculate order totals
        $tax_rate = $request->tax_rate ?? 0;
        $shipping_fee = $request->shipping_fee ?? 0;
        $coupon = Session::get('applied_coupon');
        $coupon_discount = $coupon['discount'] ?? 0;
        $tax_amount = $subtotal * ($tax_rate / 100);
        $grand_total = round($subtotal + $shipping_fee + $tax_amount - $coupon_discount, 2);

        // Create a temporary order record
        $order = new ModelsOrder();
        $order->order_number = $this->generateUniqueOrderNumber();
        $order->user_id = auth()->id();
        $order->customer_name = $request->f_name . ' ' . $request->l_name;
        $order->company_name = $request->company_name;
        $order->address = $request->address;
        $order->apartment_suite = $request->apartment_suite;
        $order->customer_email = $request->email;
        $order->customer_phone = $request->phone;
        $order->street = $request->street ?? $request->address;
        $order->zipcode = $request->zipcode;
        $order->country_id = $request->country_id;
        $order->city = $request->city;
        $order->state_id = $request->state_id;
        $order->note = $request->note;
        $order->shipping_charge = $shipping_fee;
        $order->vat = $tax_amount;
        $order->coupon_id = $coupon['coupon_id'] ?? null;
        $order->coupon_discount = $coupon_discount;
        $order->total_price = $subtotal;
        $order->grand_total = $grand_total;
        $order->order_date = now()->format('Y-m-d');
        $order->payment_method = 'sslcommerz';
        $order->payment_status = 0; // Pending
        $order->order_status = 0; // Processing
        $order->save();

        // Store order items
        $cartItems = Session::get('cart', []);
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->user_id = auth()->id();
            $orderDetail->product_id = $cartItem['product_id'];
            $orderDetail->product_title = $cartItem['title'];
            $orderDetail->product_price = $cartItem['price'];
            $orderDetail->product_quantity = $cartItem['quantity'];
            $orderDetail->save();
        }

        // Prepare SSLCommerz parameters
        $post_data = [];
        $post_data['total_amount'] = $grand_total;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order->order_number;

        // Set the correct callback URLs
        $post_data['success_url'] = route('sslcommerz.success');
        $post_data['fail_url'] = route('sslcommerz.fail');
        $post_data['cancel_url'] = route('sslcommerz.cancel');

        // Customer information
        $post_data['cus_name'] = $order->customer_name;
        $post_data['cus_email'] = $order->customer_email;
        $post_data['cus_add1'] = $order->address;
        $post_data['cus_add2'] = $order->apartment_suite ?? '';
        $post_data['cus_city'] = $order->city;
        $post_data['cus_state'] = $order->state_id;
        $post_data['cus_postcode'] = $order->zipcode;
        $post_data['cus_country'] = $order->country_id;
        $post_data['cus_phone'] = $order->customer_phone;

        // Shipping information
        $post_data['ship_name'] = $order->customer_name;
        $post_data['ship_add1'] = 'Dhaka';
        $post_data['ship_add2'] = $order->apartment_suite ?? '';
        $post_data['ship_city'] = $order->city;
        $post_data['ship_state'] = $order->state_id;
        $post_data['ship_postcode'] = $order->zipcode;
        $post_data['ship_country'] = $order->country_id;

        // Product information
        $post_data['shipping_method'] = "YES";
        $post_data['product_name'] = "Online Purchase";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        // Additional parameters
        $post_data['value_a'] = $order->id;
        $post_data['value_b'] = auth()->id() ?? 'guest';
        $post_data['value_c'] = $request->create_account ?? '0';
        $post_data['value_d'] = $coupon['code'] ?? '';

        // Initialize SSLCommerz
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            return $payment_options;
        }

        Toastr::error('Payment initialization failed');
        return redirect()->back();
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $order_id = $request->input('value_a');

        $sslc = new SslCommerzNotification();
        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

        if ($validation) {
            $order = ModelsOrder::find($order_id);

            if ($order && $order->payment_status == 0) {
                // Update order status
                $order->payment_status = 1;
                $order->order_status = 1;
                $order->save();

                // Reduce product stock
                $orderItems = OrderDetail::where('order_id', $order->id)->get();
                foreach ($orderItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->stock -= $item->product_quantity;
                        $product->save();
                    }
                }

                // Update coupon usage
                if ($order->coupon_id) {
                    $coupon = Coupon::find($order->coupon_id);
                    if ($coupon) {
                        $coupon->used_count += 1;
                        $coupon->save();
                    }
                }

                // Create account if requested
                if ($request->input('value_c') == '1') {
                    $user = new User();
                    $user->name = $order->customer_name;
                    $user->email = $order->customer_email;
                    $user->password = bcrypt(uniqid()); // Generate random password
                    $user->user_code = User::max('user_code') + 1 ?? 1001;
                    $user->username = uniqid();
                    $user->save();

                    $order->user_id = $user->id;
                    $order->save();

                    Mail::to($user->email)->send(new GuestWelcomeMail($user, $user->password));
                }

                // Send emails
                $mailConfig = Setting::first()->email_enable;
                if ($mailConfig == 1) {
                    $orderItems = OrderDetail::where('order_id', $order->id)->get();
                    Mail::to($order->customer_email)->send(new OrderConfirmationMail($order, $orderItems));

                    $adminEmail = Setting::first()->email;
                    Mail::to($adminEmail)->send(new NewOrderNotificationMail($order, $orderItems));
                }

                // Clear session
                Session::forget('cart');
                Session::forget('applied_coupon');

                // Store success message in session
                Toastr::success('success', 'Payment successful. Order confirmed!');

                // Redirect to order success page
                return redirect()->back()->with('success','Success');
            }
        }

        // If validation fails
        Toastr::error('error', 'Payment verification failed');
        return redirect()->route('sslcommerz.fail');
    }

    public function sslFail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_id = $request->input('value_a');

        $order = ModelsOrder::find($order_id);
        if ($order) {
            $order->payment_status = 2; // Failed
            $order->order_status = 4; // Cancelled
            $order->save();
        }

        Toastr::error('Payment failed. Please try again.');
        return redirect()->route('checkout');
    }

    public function sslCancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_id = $request->input('value_a');

        $order = ModelsOrder::find($order_id);
        if ($order) {
            $order->payment_status = 3; // Cancelled
            $order->order_status = 4; // Cancelled
            $order->save();
        }

        Toastr::warning('Payment cancelled by user');
        return redirect()->route('checkout');
    }



}
