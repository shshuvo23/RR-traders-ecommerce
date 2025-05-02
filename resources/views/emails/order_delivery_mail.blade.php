@component('mail::message')
# Your Order Has Been Delivered! 🚚🎉

Dear **{{ $order->customer_name }}**,

We’re happy to inform you that your order **#{{ $order->order_number }}** has been successfully delivered. 🎊  

## **Order Details:**
- **Order Number:** {{ $order->order_number }}
- **Delivery Date:** {{ now()->format('F d, Y') }}
- **Total Amount:** ${{ number_format($order->grand_total, 2) }}

We hope you enjoy your purchase! If you have any questions or concerns, please don't hesitate to contact us.

@component('mail::button', ['url' => route('shop')])
Shop Now
@endcomponent

Thank you for shopping with **{{ config('app.name') }}**.  
We appreciate your trust and support! 💖  

Best regards,  
**The {{ config('app.name') }} Team**
@endcomponent
