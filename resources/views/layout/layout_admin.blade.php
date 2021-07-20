<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{URL::asset('assets/img/favicon/polindra-fav.png')}}" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/select2/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/adminlte.css')}}">

    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item"></li>
                <li class="nav-item">

                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" href="">
                        <i class="far fa-bell fa-lg" style="margin-right: 5px;"></i>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::asset('assets/img/profile/' . Session::get('user_image'))}}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{Str::words(Session::get('user_name'), 3)}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{URL::asset('assets/img/profile/' . Session::get('user_image'))}}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{Str::words(Session::get('user_name'), 3)}}
                                <small>{{Session::get('user_email')}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{route('profile', 'me')}}" class="btn btn-default btn-flat">Profile</a>
                            <a href="{{route('logout')}}" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/home')}}" class="brand-link">
                <img src="{{URL::asset('assets/img/logo/polindra.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: 1;">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{URL::asset('assets/img/profile/' . Session::get('user_image'))}}" class="img-circle elevation-2" alt="User Image" style="height: 2.1rem;">
                    </div>
                    <div class="info">
                        <a href="{{route('profile', 'me')}}" class="d-block">{{Str::words(Session::get('user_name'), 3)}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">MENU</li>
                        <li class="nav-item">
                            <a href="{{route('admin_home')}}" class="nav-link @if(Request::segment(1) == 'home' || Request::segment(2) == 'home') {{'active'}} @endif">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item @if(Request::segment(2) == 'pengabdian'){{'menu-is-opening menu-open'}} @endif">
                            <a href="#" class="nav-link @if(Request::segment(2) == 'pengabdian') {{'active'}} @endif">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Pengabdian
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin_pengabdian_usulan')}}" class="nav-link @if(Request::segment(2) == 'pengabdian' && Request::segment(3) == 'usulan') {{'active'}} @endif">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Usulan Pengabdian
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin_pengabdian_pelaksanaan')}}" class="nav-link @if(Request::segment(2) == 'pengabdian' && Request::segment(3) == 'pelaksanaan' && Request::segment(4) == NULL) {{'active'}} @endif">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pelaksanaan Pengabdian
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin_penilaian_pelaksanaan')}}" class="nav-link @if(Request::segment(2) == 'pengabdian' && Request::segment(3) == 'pelaksanaan' && Request::segment(4) == 'penilaian') {{'active'}} @endif">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pelaksanaan Penilaian
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_data_pendukung')}}" class="nav-link @if(Request::segment(1) == 'data_pendukung' || Request::segment(2) == 'data_pendukung') {{'active'}} @endif">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data Pendukung
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_jurusan')}}" class="nav-link @if(Request::segment(1) == 'jurusan' || Request::segment(2) == 'jurusan') {{'active'}} @endif">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Jurusan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_logbook')}}" class="nav-link @if(Request::segment(1) == 'logbook' || Request::segment(2) == 'logbook') {{'active'}} @endif">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>
                                    Logbook
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_laporan_kemajuan')}}" class="nav-link @if(Request::segment(1) == 'laporan_kemajuan' || Request::segment(2) == 'laporan_kemajuan') {{'active'}} @endif">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Laporan Kemajuan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_laporan_akhir')}}" class="nav-link @if(Request::segment(1) == 'laporan_akhir' || Request::segment(2) == 'laporan_akhir') {{'active'}} @endif">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>
                                    Laporan Akhir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item @if(Request::segment(2) == 'reviewer'){{'menu-is-opening menu-open'}} @endif">
                            <a href="#" class="nav-link @if(Request::segment(2) == 'reviewer') {{'active'}} @endif">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>
                                    Reviewer
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin_reviewer')}}" class="nav-link @if(Request::segment(3) == 'daftar') {{'active'}} @endif">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Daftar Reviewer
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin_plotting_reviewer')}}" class="nav-link @if(Request::segment(3) == 'plotting') {{'active'}} @endif">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Plotting Reviewer
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_pengusul')}}" class="nav-link @if(Request::segment(1) == 'pengusul' || Request::segment(2) == 'pengusul') {{'active'}} @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pengusul
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('page')

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block" style="margin-top: -13px;">
                <b>Copyright &copy; {{date('Y')}} SIMTABMAS Polindra</b> All rights reserved.
            </div>

        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- <script src="{{URL::asset('assets/js/jquery/jquery.min.js')}}"></script> -->
    <script src="{{URL::asset('assets/js/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{URL::asset('assets/js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{URL::asset('assets/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    <script src="{{URL::asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>

    @stack('plugin')

    <!-- AdminLTE App -->
    <script src="{{URL::asset('assets/js/adminlte.min.js')}}"></script>
    <!-- Sweet Alert -->
    <!-- Own Script -->
    <script src="{{URL::asset('assets/js/ScriptSweetalert2.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('assets/js/demo.js')}}"></script>
    <!-- Page specific script -->

</body>

</html>