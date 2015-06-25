@extends('layouts.master')

@section('content')
<section class="hero">
    <section class="container">
        <h1>Order. Analyze. Repeat.</h1>
        <p>Analyze the sales of your restaurant. <br>Track your best performing items, servers, and more.</p>
        <a href="{{ url('orders/create') }}">Enter an order now.</a>
    </section>
</section>
    <div class="body-content center-block">
        <div class="row">
            <div class="instructions col-md-4">
                <h2>Analyze Orders &amp; Sales</h2>
                <ul>
                    <li>Click "Enter an order now" to begin</li>
                    <li>Enter the table number</li>
                    <li>Enter the server name</li>
                    <li>Enter today's date</li>
                    <li>View the stats!<li>
                </ul>
            </div>
            <div class="instructions col-md-4">
                <h2 style="text-align:center;">Current best selling item:<br> {{ $high_gross_item }}</h2>
                <img src="{{$high_gross_item_img}}" />
            </div>
            <div class="instructions col-md-4">
                <h2>Current Servers:</h2>
                <ol class="servers">
                    @foreach($servers as $list)
                        <li><img src="./{{ $list->server_pic }}" />{{ $list->server_firstname }} {{ $list->server_lastname }}</li>
                    @endforeach
                </ol>
            </div>
        </div><!--food list-->
    </div><!--/body-content-->
@stop
