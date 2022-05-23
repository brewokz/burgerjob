@extends('layouts.print')

@section('content')
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h2 class="page-header">
                <i class="fas fa-globe"></i> Burger Job, Inc.
                <small class="float-right">Date: {{$getDate}}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- Table row -->
    <div class="row">
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
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">

        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">{{$getDate}}</p>

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
</section>
<!-- /.content -->

<!-- ./wrapper -->
<!-- Page specific script -->



</html>