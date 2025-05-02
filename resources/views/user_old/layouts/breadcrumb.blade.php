{{-- breadcrumb --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 card-font">{{$title ?? 'Page-Header'}}</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">{{__('messages.nav.home')}}</a></li>
                    @yield('breadcrumb')
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>