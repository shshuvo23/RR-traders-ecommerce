<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $setting = getSetting();
@endphp
<head>
    <title>@yield('title')</title>

    {{-- meta info --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Md. Shakib Hossain Rijon, Md. Rabin Mia">
    <meta property="fb:app_id" content="{{ '100087492087217' }}" />
    <meta name="robots" content="index,follow">
    <meta name="Developed By" content="Arobil Limited" />
    <meta name="Developer" content="Md. Shakib Hossain Rijon" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:site_name" content="{{ $setting->site_name ?? 'venmeo' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    @if (View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="{{ $setting->site_name ?? config('app.name') }} - @yield('title')" />
        <meta property="og:description" content="Welcome to venmeo" />
        <meta property="og:image" content="" />
    @endif

    {{-- style  --}}
    <!-- favicon -->
    <link rel="icon" href="{{ getIcon($setting->favicon) }}?v=1">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    {{-- toastr style  --}}
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">

    {{-- custom style  --}}
    @stack('style')

</head>

<body style="background-color:#fafafa;">


    {{-- content section  --}}
    @yield('content')


    {{-- javascript  --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{asset('massage/toastr/toastr.js')}}"></script>
        {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif
    </script>

    {{-- custom js area  --}}

    @stack('script')

</body>

</html>
