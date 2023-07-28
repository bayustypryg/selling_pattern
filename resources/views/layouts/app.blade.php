<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Selling Pattern | {{$title}}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('assets/adminLte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/adminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/adminLte/dist/css/adminlte.min.css') }}">
        <!-- jQuery -->
        <script src="{{ asset('assets/adminLte/plugins/jquery/jquery.min.js') }}"></script>
    </head>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="{{ asset('assets/adminLte/dist/img/AdminLTELogo.png') }}"
                    alt="AdminLTELogo" height="60" width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/" class="brand-link">
                    <img src="{{ asset('assets/adminLte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Selling Pattern</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('assets/adminLte/dist/img/user2-160x160.jpg') }}"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->first_name. ' ' . Auth::user()->last_name}}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                            
                            <li class="nav-item">
                                <a href="/" class="nav-link {{Request::is('/') ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transaction') }}" class="nav-link {{Request::is('transaction') ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                    <p>
                                        Data Transaksi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('repeat-order') }}" class="nav-link {{Request::is('repeat-order') ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-sync-alt"></i>
                                    <p>
                                        Repeat Order
                                    </p>
                                </a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{$title}}</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        
        <!-- Bootstrap -->
        <script src="{{ asset('assets/adminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets/adminLte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/adminLte/dist/js/adminlte.js') }}"></script>
        
        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{ asset('assets/adminLte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('assets/adminLte/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/adminLte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('assets/adminLte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('assets/adminLte/plugins/chart.js/Chart.min.js')}}"></script>
        
        <!-- bs-custom-file-input -->
        <script src="{{ asset('assets/adminLte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        
        <!-- sweet alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(function () {
                bsCustomFileInput.init();
            });
        </script>

        @if(session()->has('error'))
            <script>
                swal({
                    title: "Error!",
                    text: "{{ session()->get('error') }}",
                    icon: "error",
                    button: "OK!",
                });
            </script>

        @elseif (session()->has('success'))
            <script>
                swal({
                    title: "Success!",
                    text: "{{ session()->get('success') }}",
                    icon: "success",
                    button: "OK!",
                });
            </script>
        @endif


        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('assets/adminLte/dist/js/demo.js') }}"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- <script src="{{ asset('assets/adminLte/dist/js/pages/dashboard2.js') }}"></script> --}}
    </body>

</html>
