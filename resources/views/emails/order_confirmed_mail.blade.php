@component('mail::message')
# Order Confirmation

Dear {{ $order->customer_name }},

Thank you for your order! We are pleased to confirm that your order **#{{ $order->order_number }}** has been successfully placed.

## **Order Details:**
- **Order Number:** {{ $order->order_number }}
- **Order Confirmed Date:** {{ $order->created_at->format('F d, Y') }}
- **Total Amount:** ${{ number_format($order->grand_total, 2) }}

Your order is now being processed, and we will notify you once it is shipped.

@component('mail::button', ['url' => route('shop')])
Shop Now
@endcomponent

If you have any questions regarding your order, please feel free to contact our support team.

Thank you for shopping with us!  
**{{ config('app.name') }}**  
@endcomponent
