<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light base-color border-bottom-0">
    @guest
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="/" class="nav-link navbar-brand">
                <img src="{{ asset('images/burger.png')}}" alt="Burger Job" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Burger Job</span>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-slide="true" href="/login" role="button">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-slide="true" href="/register/create" role="button">
                <i class="fas fa-file-import"></i> Register
            </a>
        </li> -->
    </ul>
    @else
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link {{  request()->routeIs('home') ? 'bg-secondary text-white' : '' }}"><i class="fas fa-home"></i> Beranda</a>
        </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item mr-3">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown mr-3">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="{{ asset('profile-picture/'.Auth()->User()->profile_picture)}}" class="img-circle mx-2" alt="User Image" width="30" height="30">
                {{ucwords(auth()->user()->fullname)}}
            </a>
            <!-- <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a> -->
            <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> -->
            <div class="dropdown-menu dropdown-menu-right">
                <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->

                <a href="/user/{{auth()->user()->id}}" class="dropdown-item">
                    <i class="fas fa-solid fa-user mr-2"></i> Profile
                    <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i> Logout</button>
                </form>
                <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
            </div>
        </li>
    </ul>
    @endguest
</nav>
<!-- /.navbar -->