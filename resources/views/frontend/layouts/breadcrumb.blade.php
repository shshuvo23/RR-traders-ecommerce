{{-- breadcrumb --}}
<nav class="breadcrumb-nav bg-light mb-2 border-bottom">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            @yield('breadcrumb')
            {{-- <li class="breadcrumb-item"><a href="#">About Us</a></li> --}}
        </ol>
    </div>
</nav>
