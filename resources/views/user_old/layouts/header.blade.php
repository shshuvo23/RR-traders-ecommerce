<!-- ======================= header start  ============================ -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <i class="fas fa-globe fa-2"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @php
            $lang_code = checkFrontLanguageSession() ?? geDefaultLanguage()->iso_code;
            // dd(getLanguageByKey($lang_code),getLanguageByKey(checkFrontLanguageSession()) );
        @endphp
        <li class="nav-link">
            <div class="dropdown">
                <a class="dropdown-toggle px-0 text-light" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-expanded="false">
                    <img class="flag" src="{{getIcon(getFlagByIsoCode($lang_code))}}" alt="{{ getLanguageByKey($lang_code) }}">
                    {{getLanguageByKey($lang_code)}}
                </a>
                <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuLink">
                    @foreach (getAllLanguageWithFullData() as $key => $language)
                    <li class="languageSelection m-2" data-prefix-value="{{ $language->iso_code }}">
                        <img class="flag" src="{{ getIcon($language->flag) }}" alt="{{ $language->name }}" style="height: 25px">
                        <span style="cursor: pointer;">{{ $language->name }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mr-3" data-toggle="dropdown" href="#">
                <img src="{{getProfile(auth()->user()->image)}}" width="35" alt="" class="rounded border">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('user.profile')}}" class="dropdown-item">
                    <i class="fa fa-user"></i>
                    {{__('messages.common.profile')}}
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item @yield('logout') text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i> {{__('messages.common.logout')}}
                </a>
                <form class="logout" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- ======================= header end  ============================ -->
