@extends('layouts.master')

@section('content')
<section class="hero">
    <section class="container">
        <h1>Order.Analyze.Repeat. ;lkj</h1>
        <p>Analyze the sales of your restaurant. <br>Track your best performing items, servers, and more.</p>
        <a href="{{ url('orders/create') }}">Enter an order now.</a>
    </section>
</section>
    <div class="body-content center-block">
        <div class="row">
            <div class="instructions col-md-4">
                <h2>EASY ONLINE ORDERING</h2>
                <ol>
                    <li>Click on "Make Your Order Now" button</li>
                    <li>Choose the table number</li>
                    <li>Choose the server name</li>
                    <li>Enter today's date</li>
                </ol>
            </div>
            <div class="instructions col-md-4">
                <h2 style="text-align:center;">Guess what? {{ $high_gross_item }} is our most popular dish!</h2>
                <img src="{{$high_gross_item_img}}" />
            </div>
            <div class="instructions col-md-4">
                <h2>Your servers today</h2>
                <ol class="servers">
                    @foreach($servers as $list)
                        <li><img src="./{{ $list->server_pic }}" />{{ $list->server_firstname }} {{ $list->server_lastname }}</li>
                    @endforeach
                </ol>
            </div>
        </div><!--food list-->
    </div><!--/body-content-->
@stop
