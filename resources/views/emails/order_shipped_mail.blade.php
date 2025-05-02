@component('mail::message')
# Your Order Has Been Shipped! 🚚📦

Dear **{{ $order->customer_name }}**,

Your order **#{{ $order->order_number }}** has been shipped and is on its way to you. 🎉  

We appreciate your trust in **{{ config('app.name') }}**. Thank you for shopping with us!  

@component('mail::button', ['url' => route('shop')])
Shop Now
@endcomponent

If you have any questions, feel free to reach out to us.  

Best regards,  
**The {{ config('app.name') }} Team**
@endcomponent
