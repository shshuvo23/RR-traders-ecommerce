@component('mail::message')
# Your Order Has Been Canceled ❌

Dear **{{ $order->customer_name }}**,

We regret to inform you that your order **#{{ $order->order_number }}** has been canceled.  

If this was a mistake or if you have any questions, please contact our support team for assistance.  

@component('mail::button', ['url' => route('shop')])
Shop Now
@endcomponent

We appreciate your interest in **{{ config('app.name') }}**, and we hope to serve you again in the future.  

Best regards,  
**The {{ config('app.name') }} Team**
@endcomponent
