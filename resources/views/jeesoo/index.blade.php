@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1>

@stop

@section('sidebar')    
@stop

@section('content')


@foreach($orders as $order)

<h3>{{ $order->id }} | $ {{ $order->total }} | {{ $order -> date}} | {{$order ->time }} </h3>

    <br>

@endforeach


@stop
