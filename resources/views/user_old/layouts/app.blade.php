<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $settings = getSetting();
    @endphp
    <title>@yield('title')</title>

    {{-- meta info --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Md. Shakib Hossain Rijon, Md. Rabin Mia">
    <meta property="fb:app_id" content="{{ '100087492087217' }}" />
    <meta name="robots" content="index,follow">
    <meta name="Developed By" content="Arobilo Limited" />
    <meta name="Developer" content="Md. Shakib Hossain Rijon" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:site_name" content="{{ $settings->site_name ?? 'venmeo' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    @if (View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="{{ $settings->site_name ?? config('app.name') }} - @yield('title')" />
        <meta property="og:description" content="{{$settings->seo_meta_description ?? ""}}" />
        <meta property="og:image" content="{{getIcon($settings->site_logo)}}" />
    @endif

    {{-- style  --}}
    @include('user.layouts.style')

    {{-- toastr style  --}}
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">

    {{-- custom style  --}}
    <style>
    ul.dropdown-menu.p-2.show {
        left: -50px;
        top: 32px;
    }
    .flag {
        width: 25px;
        height: 15px;
        object-fit: contain;
    }
    .buttons-html5 {
        background: linear-gradient(105deg, #5de0e6, #306ab7) !important;
        margin-right: 10px !important;
        border: 1px solid #a5e4ff !important;
        border-radius: 4px !important;
        margin-block: 5px;
    }
    .buttons-print {
        background: linear-gradient(105deg, #5de0e6, #306ab7) !important;
        border: 1px solid #a5e4ff !important;
        border-radius: 4px !important;
        margin-block: 5px;
    }
    </style>
    @stack('style')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- header section  --}}
        @include('user.layouts.header')

        {{-- Sidebar section --}}
        @include('user.layouts.sidebar')

        {{-- content section  --}}
        <div class="content-wrapper">
            @include('user.layouts.breadcrumb')
            @yield('content')
        </div>
        {{-- footer section  --}}
        @include('user.layouts.footer')
    </div>

    {{-- javascript  --}}
    @include('user.layouts.script')

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
    <script>
        var dataTables_info = "{{__('messages.datatables.showing')}} _START_ {{__('messages.datatables.to')}} _END_ {{__('messages.datatables.of')}} _TOTAL_ {{__('messages.datatables.entries')}}";
        var dataTables_length = "{{__('messages.datatables.show')}} _MENU_ {{__('messages.datatables.entries')}}";
        var paginate_button_previous = "{{__('messages.datatables.previous')}}";
        var paginate_button_next = "{{__('messages.datatables.next')}}";
        var dataTables_filter = "{{__('messages.datatables.search')}}:";
        var dataTables_copy_btn = "{{__('messages.datatables.copy')}}";
        var dataTables_print_btn = "{{__('messages.datatables.print')}}";

        // Initialize DataTable with language settings and additional configurations
        $(function () {
            $("#dataTables").DataTable({
                "responsive": true, 
                "lengthChange": true, 
                "autoWidth": false,
                "language": {
                    "info": dataTables_info,
                    "lengthMenu": dataTables_length,
                    "paginate": {
                        "previous": paginate_button_previous,
                        "next": paginate_button_next
                    },
                    "search": dataTables_filter
                },
                "buttons":  [
                                {
                                    extend: 'copy',
                                    text: dataTables_copy_btn,
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }

                                },
                                {
                                    extend: 'csv',
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'print',
                                    text: dataTables_print_btn,
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                ]
            }).buttons().container().appendTo('#dataTables_wrapper .col-md-6:eq(0)');
        });
    </script>
    {{-- custom js area  --}}

    @stack('script')

</body>

</html>
