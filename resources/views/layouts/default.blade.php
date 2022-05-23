@if(Auth::user()->is_admin == 1)
<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- fix footer -->
    <!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
    <div class="wrapper">
        <!-- Navigation -->
        @include('includes.navigation')
        <!-- Page Content -->
        <aside class="main-sidebar sidebar-light-primary shadow mb-3 shadow-lg">
            @include('includes.sidebar')
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper base-color-bg p-3">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <footer class="main-footer">
            @include('includes.footer')
        </footer>
        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
    <!-- custom admin lte gambar jendela pojok kanan atas -->
    <!-- <script src="{{ asset('templates/dist/js/demo.js')}}"></script> -->
</body>

</html>
@else
<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        @include('includes.navigationfull')
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper base-color-bg">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Footer -->
        <footer class="main-footer">
            @include('includes.footer')
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
</body>

</html>
@endif