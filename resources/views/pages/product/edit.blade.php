@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- warna custom -->
                <!-- <div class="col-md-4">
                    <a href="produk/create" class="btn btn-success btn-lg" style="background-color: #444444; border: hidden">Tambah Data</a>
                </div> -->
                <div class="col-md-4">
                    <a href="/product" class="btn btn-block bg-gradient-primary btn-lg">Back</a>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit product form</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="/product/{{$product->id}}">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <label for="sku" class="col-sm-2 col-form-label">SKU*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{$product->sku}}">
                        @error('sku')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$product->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity*</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{$product->quantity}}">
                        @error('quantity')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Price*</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$product->price}}">
                        @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Deskirpsi</label>
                    <div class="col-sm-5">
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{{$product->description}}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_picture" class="col-sm-2 col-form-label">Product Picture*</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control form-control-sm @error('product_picture') is-invalid @enderror" id="product_picture" name="product_picture" value="{{old('product_picture')}}">
                        @error('product_picture')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row float-sm-right p-2">
                    <div class="col">
                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Update Product</button>
                    </div>
                </div>
            </form>
            </script>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection