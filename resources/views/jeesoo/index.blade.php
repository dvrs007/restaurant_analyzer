@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><hr>
@stop

@section('sidebar')    
@stop

@section('content')
<hr/>
@foreach($orders as $order)

<h3>{{ $order->id }} | $ {{ $order->total }} | {{ $order -> order_date}} | {{$order ->order_time }} </h3>

    <br>

@endforeach


@stop
