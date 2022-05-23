@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header mx-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if ($message = Session::get('error'))
                <div class="alert bg-gradient-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <h1>Detail Menu</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Detail Menu</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content mx-5">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none"></h3>
                    <div class="col-12">
                        <img src="{{ asset('product-images/'.$product->product_picture)}}" class="container" alt="Product Image" width="400">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="{{ asset('product-images/'.$product->product_picture)}}" alt="Product Image"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$product->name}}</h3>
                    <p>{{$product->sku}}</p>
                    <p>{{$product->description}}</p>

                    <hr>
                    <h4>Available Stock</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <h5>{{$product->quantity}}</h5>
                    </div>

                    <div class="base-color py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            Rp. {{number_format($product->price)}}
                        </h2>
                        <!-- <h4 class="mt-0">
                            <small>Ex Tax: $80.00 </small>
                        </h4> -->
                    </div>
                    <form action="/add-to-cart/{{$product->id}}" enctype="multipart/form-data">
                        <!-- note -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="note" rows="3" placeholder="Note">@if($getOneRow != null){{$getOneRow['note']}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <h4 class="mt-3"><small>Quantity</small></h4>
                        <div class="btn-group btn-group-toggle container row" data-toggle="buttons">
                            <input type="number" value="1" name="quantity" id="quantity" @if($getOneRow !=null) value="{{$getOneRow['quantity']}}" @endif>
                            <button type="submit" class="btn btn-success btn-lg btn-flat ml-3">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </form>
                    <div class="mt-4 product-share">
                        <a href="#" class="text-gray">
                            <i class="fab fa-facebook-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fab fa-twitter-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-envelope-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-rss-square fa-2x"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection