<nav class="main-header navbar navbar-expand-md navbar-light navbar-light base-color border-bottom-0">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/burger.png')}}" alt="Burger Job" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Burger Job</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>

                @if(@Auth()->user()->is_admin == 0)
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart
                        <!-- <span class="badge badge-danger navbar-badge">15</span> -->
                        @if($countCart == 0)
                        @else
                        <span class="badge badge-danger navbar-badge center">
                            <small>
                                {{$countCart}}
                            </small>
                        </span>
                        @endif
                    </a>
                </li>
                @endif
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown mr-1">
                <a href="#" class="navbar-brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <img src="{{ asset('profile-picture/'.Auth()->User()->profile_picture)}}" class="img-circle mx-2" alt="User Image" width="30" height="30">
                    <span class="brand-text font-weight-light">{{ucwords(auth()->user()->fullname)}}</span>
                </a>
                <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> -->
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
                    <div class="dropdown-divider"></div>
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
    </div>
</nav>