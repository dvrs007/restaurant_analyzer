@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Restaurant Analyzer

@stop

@section('sidebar')
    

    <p>Welcome to the About Page</p>
@stop

@section('content')
    <h2>Data Analysis by Server</h2>
    <h3>Currently, a total of servers have taken orders.</h3>
    <!--chart code -->
    <div id="myStocks"></div>
    
    <?php 
    // Example #1, output into a div you already created
    echo Lava::render('BarChart', 'myFancyChart', 'myStocks'); 
    ?>
    
    @foreach($results as $item)

<h3>
    Order ID: {{ $item->order_id }}<br>
    Subtotal: {{ $item->subtotal }}<br>
    Table Number: {{ $item->tbl_number }}<br>
    Server: {{ $item->server }}<br>
    Items:
    {{ $item->item_name }} 
    <br>
    
    <br>
    
    </h3>

    <br>

@endforeach

@stop