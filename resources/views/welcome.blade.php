@extends('layouts.master')

@section('content')
<section class="hero">
                            <section class="container">
                                <h1>Order.Eat.Repeat.</h1>
                                <p>Our mobile ordering application for iOS, Android and tablet helps you and your consumers order in advance, pay in advance and build relationships.</p>
                                <a href="{{ url('orders/create') }}">Make your order now!</a>
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