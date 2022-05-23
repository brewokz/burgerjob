@extends('layouts.default')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if ($message = Session::get('remove'))
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
                <h1>Invoice</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Make sure the order is correct before checkout.
                </div>


                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Burger Job, Inc.
                                <small class="float-right">Date: {{$getDate}}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Admin, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>John Doe</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> 4F3S8J<br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> 968-34567
                        </div>
                    </div> -->

                    <!-- Table row -->
                    <div class="row mt-5">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Name</th>
                                        <th>SKU #</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                    <tr>
                                        <td>{{$item['quantity']}}</td>
                                        <td>{{ucwords($item['name'])}}</td>
                                        <td>{{$item['sku']}}</td>
                                        <td>Rp. {{number_format($item['price'])}}</td>
                                        <td>{{$item['description']}}</td>
                                        <td>Rp. {{number_format($item['subtotal'])}}</td>
                                        <td>{{$item['note']}}</td>
                                        <td>
                                            <a href="/product/{{$item['id']}}" class="badge badge-warning"><i class="far fa-edit"></i></a>
                                            <a href="/delete-to-cart/{{$item['id']}}" class="badge badge-danger" onclick="return confirm('Are you sure you want to remove ?')"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <form action="/checkout" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                        <option value="cash" @if(old('payment_method')=='0' ) selected @endif>Cash</option>
                                        <option value="virtual money" @if(old('payment_method')=='1' ) selected @endif>Virtual money</option>
                                    </select>
                                    @error('payment_method')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <p class="lead mt-3">Split Bill:</p>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('is_split_bill') is-invalid @enderror" id="is_split_bill" name="is_split_bill">
                                        <option value="0" @if(old('is_split_bill')=='0' ) selected @endif>No</option>
                                        <option value="1" @if(old('is_split_bill')=='1' ) selected @endif>Yes</option>
                                    </select>
                                    @error('is_split_bill')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <p class="lead mt-3" style="display:none;" id="showp">Split Bill:</p>
                                <div class="col-sm-10" style="display:none;" id="show">
                                    <input type="number" class="form-control @error('number_of_split') is-invalid @enderror" id="number_of_split" name="number_of_split" value="{{old('number_of_split')}}">

                                    </input>
                                    @error('number_of_split')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">{{$getDate}}</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>Rp. {{number_format($total)}}</td>
                                        </tr>
                                        <!-- <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                        </tr> -->
                                        <tr>
                                            <th>Total:</th>
                                            <td>Rp. {{number_format($total)}}</td>
                                            <input type="number" value="{{$total}}" name="total_price" hidden>
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
                                <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                                <button type="submit" class="btn btn-success float-right" onclick="return confirm('Are you sure you want to checkout ?')"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script>
    $('#is_split_bill').on('change', function() {
        if (this.value == "1") {
            $('#showp').show();
            $('#show').show();
        } else {
            $('#showp').hide();
            $('#show').hide();
        }
    });
</script>
@endsection