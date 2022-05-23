@extends('layouts.default')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if ($message = Session::get('create'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <h1 class="bg-green p-3 rounded">Payment Success</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    <a href="/">go home</a>
                </div> -->

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Burger Job, Inc.
                                <small class="float-right">Date: {{date_format(date_create($getLastOrder->date),"d-m-Y")}}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <!-- From
                            <address>
                                <strong>Admin, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address> -->
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <!-- To
                            <address>
                                <strong>John Doe</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address> -->
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice </b><br>
                            <br>
                            <b>Order ID:</b> {{$getLastOrder->slug}}<br>
                        </div>
                    </div>

                    <!-- Table row -->
                    <div class="row mt-5">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Note</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportlastOrder as $item)
                                    <tr>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{ucwords($item->name)}}</td>
                                        <td>Rp. {{number_format($item->price)}}</td>
                                        @if($item->note == null)
                                        <td>-</td>
                                        @else
                                        <td>{{$item->note}}</td>
                                        @endif
                                        <td>Rp. {{number_format($item->total_price)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">{{date_format(date_create($getLastOrder->date),"d-m-Y")}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>Rp. {{number_format($getLastOrder->total_price)}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr> -->
                                    <tr>
                                        <th>Amount of split bill:</th>
                                        @if($getLastOrder->amount_split_bill == null)
                                        <td>-</td>
                                        @else
                                        <td>Rp. {{number_format($getLastOrder->amount_split_bill)}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>Rp. {{number_format($getLastOrder->total_price)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print mt-5">
                        <div class="col-12">
                            <a href="/" class="btn btn-success float-right ml-3"></i> Go Home</a>
                            <a href="/print" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
                            <!-- <a href="/pdf" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </a> -->
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection