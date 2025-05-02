@component('mail::message')
# New Order Received (Order #{{ $order->order_number }})

A new order has been placed by **{{ $order['customer_name'] }}**.

### **Customer Details:**
- **Order Date:** {{ date('d M Y', strtotime($order->created_at)) }}
- **Name:** {{ $order->customer_name }}
- **Email:** {{ $order->customer_email }}
- **Phone:** {{ $order->customer_phone }}
- **Address:** {{ $order->street }}, {{ $order->city }},{{$order->zipcode}}
- **State :** {{ $order->state->name }}
- **Country :** {{ $order->country->name }}


### **Order Summary:**
@if ($order->payment_method == 'stripe')
- **Payment Method:** Stripe
@else
- **Payment Method:** Cash on Delivery
@endif
@if ($order->payment_status == '1')
- **Payment status:** Paid
@else
- **Payment status:** Due
@endif

{{-- - **Subtotal:** ${{ number_format($order->total_price, 2) }}
- **Shipping Fee:** ${{ number_format($order->shipping_charge, 2) }}
- **Tax:** ${{ number_format($order->vat, 2) }}
@if ($order->coupon_id != null)
- **Coupon Discount:** ${{ number_format($order->coupon_discount, 2) }}
@endif
- **Grand Total:** ${{ number_format($order->grand_total, 2) }} --}}
@component('mail::table')
| Product          | Price  | Quantity | Total  |
|------------------|--------|----------|--------|
@foreach ($orderItems as $item)
| {{ $item->product_title }} | ${{ number_format($item->product_price, 2) }} | {{ $item->product_quantity }} | ${{ number_format($item->product_price * $item->product_quantity, 2) }} |
@endforeach
|     |        |      **Subtotal**     | ${{ number_format($order->total_price, 2) }} |
| |        |       **Shipping Fee**    | ${{ number_format($order->shipping_charge, 2) }} |
|          |        |     **Tax**      | ${{ number_format($order->vat, 2) }} |
@if ($order->coupon_id != null)
| |    |         **Coupon Discount**  | ${{ number_format($order->coupon_discount, 2) }} |
@endif
|   |        |     **Grand Total**     | ${{ number_format($order->grand_total, 2) }} |
@endcomponent**Order notes :** {{$order['note']}}

@component('mail::button', ['url' => route('admin.order.show', $order['id'])])
View Order
@endcomponent

Best regards,
**{{ config('app.name') }}**
@endcomponent
