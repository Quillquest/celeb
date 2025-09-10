@extends('layouts.invoice')
@section('content')
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <span><img src="{{ asset('storage/' . $settings->logo) }}" width="150" height="39"></span>
                    <small class="pull-right">{{ $settings->created_at }}</small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                SENDER <address>
                    <h4><strong>{{ $user->sname }}</strong></h4><br>

                    <b>Phone:</b>{{ $user->sphone }}<br />
                    <b>Address:</b> {{ $user->saddress }}<br />
                    <b>Email:</b> {{ $user->semail }}<br />
                    <b>Country Origin:</b> {{ $user->scountry }}<br />


                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                RECIPIENT <address>
                    <h4><strong>{{ $user->sname }}</strong></h4><br>

                    <b>Phone:</b> {{ $user->phone }}<br />
                    <b>Address:</b> {{ $user->address }} <br />
                    <b>Email:</b> {{ $user->email }}<br />
                    <b>Destination Country:</b> {{ $user->country }}<br />


                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <table>
                    <tr>
                        <td>
                            <center>
                                <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $user->trackingnumber }}&code=Code128"
                                    alt="{{ $user->trackingnumber }}">

                            </center>
                        </td>

                    </tr>
                </table>
                <br />
                <b>Shipping Weight:</b>&nbsp;{{ $user->weight }}<br />
                <b>Payment Method:</b> <small class="label label-danger"><i
                        class="fa fa-money"></i>&nbsp;&nbsp;{{ $method }}</small><br />
                <b>Shipping Amount:</b>&nbsp;{{ $amount }}{{ $settings->s_currency }}&nbsp;<br />
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th>Quantity</th> --}}
                            <th>Product</th>
                            <th>Status</th>
                            <th>Current Location</th>
                            <th>Description</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>1</td> --}}
                            <td>{{ $user->shipment_type }}</td>
                            <td><small class="label label-success">{{ $user->status }} </small></td>
                            <td><small class="label label-info">{{ $user->addresslocation }} </small></td>
                            <td>{{ $user->description }}</td>
                            <td>{{ $settings->s_currency }}&nbsp;{{ $amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <br>
        <br>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Methods of Payment:{{ $method }}</p>
                <img src="{{ $settings->site_address }}/temp/securepayment.png" alt="Methods payments" />
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    For your convenience we have several reliable, fast and secure payments. </p>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{ $settings->s_currency }}&nbsp;{{ $amount }}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td> {{ $settings->s_currency }}&nbsp;{{ $amount }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
@endsection
