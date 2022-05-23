@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header mx-5">
    <div class="container-fluid ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Product Report</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <!-- warna custom -->
                <!-- <div class="col-md-4">
                    <a href="produk/create" class="btn btn-success btn-lg" style="background-color: #444444; border: hidden">Tambah Data</a>
                </div> -->
                @if ($message = Session::get('create'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle text-white"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('change'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle text-white"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('delete'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Report per day -->
    <!-- Default box -->
    <div class="card shadow p-3 mb-5 rounded" style="background-color: #FFFDF7;">
        <div class="card-header">
            <h5 class="card-title">Report sales per day</h5>
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
            <!-- data table dimasukan class table-responsive jika mau dibawahnya bs discroll dan responsive di jquery di falsekan -->
            <!-- display nowrap tampilan table compact dan rapih -->
            <table id="example1" class="table display nowrap table-hover  table-striped table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Total Quantity Order</th>
                        <th>Price</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productOrderDay as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->sku}}</td>
                        <td>{{ucwords($data->name)}}</td>
                        <td>{{$data->total_quantity}}</td>
                        <td>Rp. {{number_format($data->price)}}</td>
                        <td>Rp. {{number_format($data->total_price_result)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->


    <!-- Report per week -->
    <!-- Default box -->
    <div class="card shadow p-3 mb-5 rounded" style="background-color: #FAFBFF;">
        <div class="card-header">
            <h5 class="card-title">Report sales per week</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- data table dimasukan class table-responsive jika mau dibawahnya bs discroll dan responsive di jquery di falsekan -->
            <!-- display nowrap tampilan table compact dan rapih -->
            <table id="report1" class="table display nowrap table-hover  table-striped table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Total Quantity Order</th>
                        <th>Price</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productOrderWeek as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->sku}}</td>
                        <td>{{ucwords($data->name)}}</td>
                        <td>{{$data->total_quantity}}</td>
                        <td>Rp. {{number_format($data->price)}}</td>
                        <td>Rp. {{number_format($data->total_price_result)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <!-- Report per month -->
    <!-- Default box -->
    <div class="card shadow p-3 mb-5 rounded" style="background-color: #FBF7F9;">
        <div class="card-header">
            <h5 class="card-title">Report sales per month</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- data table dimasukan class table-responsive jika mau dibawahnya bs discroll dan responsive di jquery di falsekan -->
            <!-- display nowrap tampilan table compact dan rapih -->
            <table id="report2" class="table display nowrap table-hover  table-striped table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Total Quantity Order</th>
                        <th>Price</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productOrderMonth as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->sku}}</td>
                        <td>{{ucwords($data->name)}}</td>
                        <td>{{$data->total_quantity}}</td>
                        <td>Rp. {{number_format($data->price)}}</td>
                        <td>Rp. {{number_format($data->total_price_result)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.card-footer-->
    </div>

    <!-- Report all of time -->
    <!-- Default box -->
    <div class="card shadow p-3 mb-5 rounded" style="background-color: #EBEBEB;">
        <div class="card-header">
            <h5 class="card-title">Report sales all of time</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- data table dimasukan class table-responsive jika mau dibawahnya bs discroll dan responsive di jquery di falsekan -->
            <!-- display nowrap tampilan table compact dan rapih -->
            <table id="report3" class="table display nowrap table-hover  table-striped table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Total Quantity Order</th>
                        <th>Price</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productOrder as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->sku}}</td>
                        <td>{{ucwords($data->name)}}</td>
                        <td>{{$data->total_quantity}}</td>
                        <td>Rp. {{number_format($data->price)}}</td>
                        <td>Rp. {{number_format($data->total_price_result)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection