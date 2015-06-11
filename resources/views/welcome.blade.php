@extends('layouts.master')

@section('content')
<section class="hero">
    <section class="container">
        <h1>Order.Analyze.Repeat.</h1>
        <p>Analyze the sales of your restaurant. <br>Track your best performing items, servers, and more.</p>
        <a href="{{ url('orders/create') }}">Enter an order now.</a>
    </section>
</section>
    <div class="body-content">
        <div class="row">
            <div class="col-md-8">
                <h2>EASY ONLINE ORDERING</h2>
                <ol>
                    <li>Click on "Make Your Order Now" button</li>
                    <li>Choose the table number</li>
                    <li>Choose the server name</li>
                    <li>Enter today's date</li>
                </ol>
            </div>
            <div class="col-md-4">{{ $itemRand }}</div>
        </div><!--food list-->
    </div><!--/body-content-->
@stop