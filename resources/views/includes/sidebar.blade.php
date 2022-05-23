<!-- Brand Logo -->
<a href="/" class="brand-link">
    <img src="{{ asset('images/burger-job-logo.jpg')}}" alt="Burger Job" class="brand-image img-circle">
    <span class="brand-text font-weight-bold">Burger Job</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline pb-3 d-flex"></div>

    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header text-bold">Main Menu</li>
            <li class="nav-item mt-3">
                <a href="/home" class="nav-link {{  request()->routeIs('home') ? 'accent-color text-dark  rounded' : '' }}">
                    <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>

            @if (auth()->user()->is_admin === 1)
            <li class="nav-header text-bold mt-3">Master Data</li>
            <li class="nav-item mt-3">
                <a href="/product" class="nav-link {{  request()->routeIs('product') ? 'accent-color text-dark' : '' }}">
                    <i class="nav-icon fas fa-hamburger"></i>
                    <p>
                        Product
                    </p>
                </a>
            </li>
            @endif
            @if (auth()->user()->is_admin === 1)
            <li class="nav-item mt-3">
                <a href="/report" class="nav-link {{  request()->routeIs('report') ? 'accent-color text-dark' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Report
                    </p>
                </a>
            </li>
            @endif
            @if (auth()->user()->is_admin === 1)
            <li class="nav-item mt-3">
                <a href="/order" class="nav-link {{  request()->routeIs('order') ? 'accent-color text-dark' : '' }}">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Order
                    </p>
                </a>
            </li>
            @endif
            @if (auth()->user()->is_admin === 1)
            <li class="nav-item mt-3">
                <a href="/user" class="nav-link {{  request()->routeIs('user') ? 'accent-color text-dark' : '' }}">
                    <i class="nav-icon fas fa-smile"></i>
                    <p>
                        Employee
                        <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>