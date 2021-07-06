@php

$profile_layout = NULL;

if(Session::get('user_role') == "admin"){
$profile_layout = 'layout.layout_admin';
}elseif(Session::get('user_role') == "reviewer"){
$profile_layout = 'layout.layout_reviewer';
}elseif(Session::get('user_role') == "pengusul"){
$profile_layout = 'layout.layout_pengusul';
}

@endphp

@extends($profile_layout)

@section('title', '404 Not Found')

@section('page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="error-page ">
                        <h2 class="headline text-warning"> 404</h2>

                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                            <p>
                                We could not find the page you were looking for.
                                Meanwhile, you may <a href="{{route('admin_home')}}">return to your correct page</a>
                            </p>

                        </div>
                        <!-- /.error-content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection