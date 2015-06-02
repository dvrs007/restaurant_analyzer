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

<h3><!--a href="{{ url('/orders', $order->id) }}"-->
    {{ $order->id }}: <br/>
    Table #:{{$order->tbl_number }} <br/>
    Server :{{$order->server }}
    at {{ $order->date}} {{ $order->time }} <br/>
    (Ref: datetime: {{ $order->datetime}}) <br/>
    Subtotal: ${{ $order->subtotal}}<br/>
    Tax(13%): ${{ $order->tax}}<br/>
    Total   : ${{ $order->total}}<br/>
</h3>
<br>
@endforeach
@stop

