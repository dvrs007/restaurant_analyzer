@extends('layouts.master')

@section('content')
<hr/>
<h1>List of Orders</h1>

<a href="{{ url('orders')  }}">List of Orders</a>
|
<a href="{{ url('orders/create')  }}">Create</a>
|
<a href="{{ url('/')}}">Home</a>
<br/>
<hr/>

@foreach($orders as $order)

<h3><a href="{{ url('/orders', $order->id) }}">
    Order Number: {{ $order->id }}<br/>
    Table #:{{$order->tbl_number }} <br/>
    Server :{{$order->server }} <br/>
    Ordered at {{ $order->order_date}} {{ $order->order_time }} <br/></a>
    
    Subtotal: ${{ $order->subtotal}}<br/>
    Tax(13%): ${{ $order->tax}}<br/>
    Total   : ${{ $order->total}}<br/>
</h3>
<br>


@endforeach
@stop

