<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="hold-transition layout-top-nav layout-fixed layout-navbar-fixed">
    <!-- fix footer -->
    <!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
    <div class="wrapper">
        <!-- Navigation -->
        @include('includes.navigation')
        <!-- Page Content -->
        <div class="content-wrapper d-flex justify-content-center">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <footer class="main-footer">
            @include('includes.footer')
        </footer>
    </div>
    <!-- custom admin lte gambar jendela pojok kanan atas -->
    <!-- <script src="{{ asset('templates/dist/js/demo.js')}}"></script> -->
</body>

</html>