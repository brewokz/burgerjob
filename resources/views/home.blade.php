@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 mx-5">
                <div class="col-sm-6 container">
                    @if ($message = Session::get('error'))
                    <div class="alert bg-gradient-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @elseif ($message = Session::get('success'))
                    <div class="alert bg-gradient-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content mx-5 px-5">
    @if(@Auth()->user()->is_admin == 1)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hello, Welcome to burger job</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Product</div>
                <div class="card-body">
                    <h5 class="card-title">Cook your best product</h5>
                    <p class="card-text">This is a quick card for you food and baverage. Serve and improve your burger and baverage</p>
                    <a href="/product" class="btn btn-light">Go</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Report</div>
                <div class="card-body">
                    <h5 class="card-title">Present and Analyze It</h5>
                    <p class="card-text">Digging deep you next action plan from this report, and create an amazing sale</p>
                    <a href="/report" class="btn btn-light">Go</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Order</div>
                <div class="card-body">
                    <h5 class="card-title">Check out your awesome sale today</h5>
                    <p class="card-text">Some customer is so happy to buy tons of burger from you. Don't miss it out</p>
                    <a href="/order" class="btn btn-light">Go</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Employee</div>
                <div class="card-body">
                    <h5 class="card-title">Be one be family</h5>
                    <p class="card-text">Let's build an strong relationship with your employee, then be prepare what they can do for you</p>
                    <a href="/user" class="btn btn-light">Go</a>
                </div>
            </div>
        </div>
    </div>

    @else
    <!-- <h5 class="text-center display-4">Search Menu</h5> -->

    <form enctype="multipart/form-data" action="/search">
        <div class="col-md-10 offset-md-1">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <input type="search" class="form-control form-control-lg" placeholder="Search" id="name" name="name" value="{{request('name')}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default" id="btn-search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    @if ($message = Session::get('empty'))
                    <div class="alert bg-gradient-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 p-md-5 row-cols-sm-1 row-cols-md-3 row-cols-lg-4">
        @foreach($products as $data)
        <div class="col">
            <div class="card">
                <a href="/product/{{$data->id}}">
                    <img src="{{ asset('product-images/'.$data->product_picture)}}" class="card-img-top" alt="..." width="150">
                </a>
                <div class="card-body">
                    <a href="/product/{{$data->id}}">
                        <h5 class="card-title font-weight-bold" style="color: #F76E11;">{{$data->name}}</h5><br>
                    </a>
                    <h6 class="mt-2">Rp. {{number_format($data->price)}}</h6>
                    <div class="row">
                        <div class="col-5">
                            <small class="text-muted">Stock {{$data->quantity}}</small>
                        </div>
                        @if($data->quantity > 0)
                        <div class="col-7">
                            <div class="text-right">
                                <a href="/add-to-cart/{{$data->id}}" style="background-color: #F76E11; border: hidden" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add</a>
                            </div>
                        </div>
                        @else
                        <div class="col-7">
                            <div class="text-right">
                                <a style="background-color: #707070; border: hidden" class="btn btn-secondary" aria-disabled="true"><i class="fas fa-cart-plus"></i> Sold Out</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- <div class="card-deck">
        <div class="card text-white bg-green m-4">
            <div class="card-header">Products</div>
            <div class="card-body">
                <h5 class="card-title">Primary card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <div class="card text-black m-4">
            <div class="card-header">
                <i class="fas fa-hamburger fa-8x d-flex justify-content-center"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text">Let's take a look your report</p>
            </div>
        </div>

    </div> -->


</section>
<!-- <script>
    $(document).ready(function() {
        $('#btn-search').on('click', function() {
            let unit_id = $('#unit_id').val();
            let pkwt_type = $('#pkwt_type').val();
            let employee_name = $('#employee_name').val();
            if (!unit_id && !pkwt_type && !employee_name) {
                alert("Tidak Ada yang difilter");
            } else {
                false
            }
        })
    });
</script> -->
<!-- /.content -->
@endsection