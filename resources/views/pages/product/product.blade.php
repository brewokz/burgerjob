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
                @if ($message = Session::get('create'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('change'))
                <div class="alert bg-gradient-primary alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('delete'))
                <div class="alert bg-gradient-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert bg-gradient-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="col-md-4">
                    <a href="product/create" class="btn btn-block bg-gradient-green  text-white">Create</a>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Product</h3>

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
            <table id="example1" class="table display nowrap table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->sku}}</td>
                        <td>{{ucwords($data->name)}}</td>
                        <td>{{$data->quantity}}</td>
                        <td>Rp. {{number_format($data->price)}}</td>
                        <td>
                            @if($data->description === null)
                            -
                            @else
                            {{$data->description}}
                            @endif
                        </td>
                        <td>
                            <!-- <a href="/product/{{$data->id}}" class="badge badge-info"><i class="far fa-eye"></i></a> -->
                            <a href="/product/{{$data->id}}/edit" class="badge badge-success"><i class="far fa-edit"></i></a>
                            <!-- <a href="" class="badge badge-danger">delete</a> -->
                            <form action="/product/{{$data->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="badge badge-danger border-0" onclick="return confirm('Are you sure you want to delete ?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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