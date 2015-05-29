@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Sales Chart

@stop

@section('sidebar')
    

    <h1>Statistics on the sales of each item</h1>
    
    
    <?php 
    
    echo Lava::render('BarChart', 'TotalSales', 'sales_div', array('height'=>700, 'width'=>1000))  ?>

    
    <ul>
        @foreach($order as $ord)
 
        <li>{{ $ord->item_name }} </li>
        <li>Price: ${{ $ord->item_price }} | Cost: ${{ $ord->item_cost }} </li>

        @endforeach
    </ul>
    
    
@stop

@section('content')
    <p>This is a website built using Laravel, PHP, and Bootstrap. It's very basic right now and doesn't really do anything, but soon I will connect a database to it and it will be totally mind-boggling.</p>
@stop