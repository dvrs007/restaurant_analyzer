@extends('layouts.master')

@section('content')

<h2>List of Items for Order# {{ $order->id}}</h2>


<h3><a href="{{ URL::to('/orders')}}/{{$order->id}}/items"></a></h3>
Table#:{{ $order->tbl_number}}<br/>
Server:{{ $order->server}}<br/>
Ordered at:{{ $order->order_date}} {{ $order->order_time}}
<div>
    <!!- for each loop thru items for this order-->
    <table class="table table-bordered table-condensed table-responsive table-hover table-striped">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Ordered Quantity</th>
                <th>$</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result ->item_name}}</td>
                <td>{{ $result ->item_price}}</td>
                <td>{{ $result -> ordered_quantity }}</td>
                <td>{{ $result ->item_price * $result -> ordered_quantity}}</td>
            </tr>
            @endforeach
            <tr><td colspan="3">Sub-total</td><td>{{ $result->subtotal }}</td></tr>
            <tr><td colspan="3">Tax</td><td>{{ $result->tax }}</td></tr>
            <tr><td colspan="3">Total</td><td>{{ $result->total }}</td></tr>
        </tbody>

    </table>
</div>
<br>

@stop