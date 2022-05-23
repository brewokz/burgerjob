@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header mx-5">
    <div class="container-fluid ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Product Order</li>
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
            <h5 class="card-title">Report order per day</h5>
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
                        <th>Cashier</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Split Bill</th>
                        <th>Number of Split Bill</th>
                        <th>Amount of Split Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDay as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($item->fullname)}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{date_format(date_create($item->date),"d-F-Y")}}</td>
                        <td>Rp. {{number_format($item->total_price)}}</td>
                        <td>{{ucwords($item->payment_method)}}</td>
                        <td>
                            @if($item->is_split_bill == 1)
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($item->number_of_split == null)
                            Split 0
                            @else
                            Split {{$item->number_of_split}}
                            @endif
                        </td>
                        <td>
                            @if($item->amount_split_bill == null)
                            Rp. {{number_format(0)}}
                            @else
                            Rp. {{number_format($item->amount_split_bill)}}
                            @endif
                        </td>
                        <td>
                            <a href="/order/{{$item->id}}/show" class="badge badge-info"><i class="fas fa-eye"></i></a>
                        </td>
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
            <h5 class="card-title">Report order per week</h5>
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
                        <th>Cashier</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Split Bill</th>
                        <th>Number of Split Bill</th>
                        <th>Amount of Split Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderWeek as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($item->fullname)}}</td>
                        <td>{{$item->id}}sss</td>
                        <td>{{date_format(date_create($item->date),"d-F-Y")}}</td>
                        <td>Rp. {{number_format($item->total_price)}}</td>
                        <td>{{ucwords($item->payment_method)}}</td>
                        <td>
                            @if($item->is_split_bill == 1)
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($item->number_of_split == null)
                            Split 0
                            @else
                            Split {{$item->number_of_split}}
                            @endif
                        </td>
                        <td>
                            @if($item->amount_split_bill == null)
                            Rp. {{number_format(0)}}
                            @else
                            Rp. {{number_format($item->amount_split_bill)}}
                            @endif
                        </td>
                        <td>
                            <a href="/order/{{$item->id}}/show" class="badge badge-info"><i class="fas fa-eye"></i></a>
                        </td>
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
            <h5 class="card-title">Report order per month</h5>
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
                        <th>Cashier</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Split Bill</th>
                        <th>Number of Split Bill</th>
                        <th>Amount of Split Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderMonth as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($item->fullname)}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{date_format(date_create($item->date),"d-F-Y")}}</td>
                        <td>Rp. {{number_format($item->total_price)}}</td>
                        <td>{{ucwords($item->payment_method)}}</td>
                        <td>
                            @if($item->is_split_bill == 1)
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($item->number_of_split == null)
                            Split 0
                            @else
                            Split {{$item->number_of_split}}
                            @endif
                        </td>
                        <td>
                            @if($item->amount_split_bill == null)
                            Rp. {{number_format(0)}}
                            @else
                            Rp. {{number_format($item->amount_split_bill)}}
                            @endif
                        </td>
                        <td>
                            <a href="/order/{{$item->id}}/show" class="badge badge-info"><i class="fas fa-eye"></i></a>
                        </td>
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

    <!-- Report All -->
    <!-- Default box -->
    <div class="card shadow p-3 mb-5 rounded" style="background-color: #EBEBEB;">
        <div class="card-header">
            <h5 class="card-title">Report order all of time</h5>
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
                        <th>Cashier</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Split Bill</th>
                        <th>Number of Split Bill</th>
                        <th>Amount of Split Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($item->fullname)}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{date_format(date_create($item->date),"d-F-Y")}}</td>
                        <td>Rp. {{number_format($item->total_price)}}</td>
                        <td>{{ucwords($item->payment_method)}}</td>
                        <td>
                            @if($item->is_split_bill == 1)
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($item->number_of_split == null)
                            Split 0
                            @else
                            Split {{$item->number_of_split}}
                            @endif
                        </td>
                        <td>
                            @if($item->amount_split_bill == null)
                            Rp. {{number_format(0)}}
                            @else
                            Rp. {{number_format($item->amount_split_bill)}}
                            @endif
                        </td>
                        <td>
                            <a href="/order/{{$item->id}}/show" class="badge badge-info"><i class="fas fa-eye"></i></a>
                        </td>
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