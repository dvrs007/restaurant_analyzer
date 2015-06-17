@extends('layouts.master')

@section('title')
Order#{{ $order->id}}
@stop

@section('content')
<div class="main-title">
    <h2>Details of Order# {{ $order->id}}    
        <div class="create_link"><a href="{{ url('orders')  }}"><span class="glyphicon glyphicon-list-alt"></span></a></div>       
    </h2>
</div>
<div class="row">
    <div class="col-lg-10 center-block">
        <h3><a href="{{ URL::to('/orders')}}/{{$order->id}}/items"></a></h3>
        Table#:{{ $order->tbl_number}}<br/>
        Server:{{ $order->server}}<br/>
        Ordered at:{{ $order->order_date}} {{ $order->order_time}}
        <br/><br/>
        
        <div>
            <!!- for each loop thru items for this order-->

            <table class="table table-bordered table-condensed table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center;">Item Name</th>
                        <th style="text-align:center;">Price</th>
                        <th style="text-align:center;">Ordered Quantity</th>
                        <th style="text-align:center;">$</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                    <tr>
                        <td>{{ $result ->item_name}}</td>
                        <td style="text-align:right;">{{ $result ->item_price}}</td>
                        <td>{{ $result -> ordered_quantity }}</td>
                        <td style="text-align:right;">{{ number_format($result ->item_price * $result -> ordered_quantity,2) }}</td>
                    </tr>
                    @endforeach
                    <tr style="background-color:#c3d1d8;text-align:right;"><td colspan="3">Sub-total</td><td style="color:blueviolet;">{{ number_format($result->subtotal,2) }}</td></tr>
                    <tr style="background-color:#c3d1d8;text-align:right;"><td colspan="3">Tax</td><td style="color:blueviolet;">{{ $result->tax }}</td></tr>
                    <tr style="background-color:#8aaae8;text-align:right;"><td colspan="3">Total</td><td style="font-weight:bolder;color:white">$ {{ $result->total }}</td></tr>
                </tbody>
            </table>
        </div>       
     </div><!--/.col-lg-10 center-block-->
</div><!--/.row-->
@stop