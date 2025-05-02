@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $data->name }}!

We're excited to have you onboard. Your account has been successfully created.

@component('mail::panel')
**Email:** {{ $data->email }} <br>
**Password:** {{ $user_password }}
@endcomponent


@component('mail::button', ['url' => url('/')])
Visit Our Website
@endcomponent

If you have any questions, feel free to reach out.

Thanks again, <br>
**The {{ config('app.name') }} Team**

@endcomponent
