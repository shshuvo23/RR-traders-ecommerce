{{-- breadcrumb --}}


<section class="breadcrumb-area">
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="breadcrumb-index">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-ul">
                        <li class="breadcrumb-li">
                            <a class="breadcrumb-link" href="{{ route('home') }}">Home</a>
                        </li>@yield('breadcrumb')
                        {{-- <li class="breadcrumb-li">
                            <span class="breadcrumb-text">Collection list left</span>
                        </li> --}}
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <nav class="breadcrumb-nav bg-light mb-2 border-bottom">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            @yield('breadcrumb')
            <li class="breadcrumb-item"><a href="#">About Us</a></li>
        </ol>
    </div>
</nav> --}}
