@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('maintitle')
Restaurant Analyzer

@stop

@section('sidebar')
    
@stop

@section('content')
<div class="main-graph-title">
    <h2>Data Analysis by Server</h2>
</div>
    <div class="graph-title">
        <h3>Sales Performance by Server</h3>
    </div>

    <!--chart code -->
    <div id="myStocks"></div>
    
    <?php 
    // Example #1, output into a div you already created
    echo Lava::render('BarChart', 'myFancyChart', 'myStocks'); 
    ?>
    
    <div class="graph-title">
        <h3>Currently, a total <span class="blue">{{ $serverscount}}</span> of servers have taken orders.</h3>
    </div>
    
    <div class="main-graph-title">
    <h2>Data Analysis by Table</h2>
</div>
    <div class="graph-title">
        <h3>Sales Performance by Table</h3>
    </div>

    <!--chart code -->
    <div id="tablezChart"></div>
    
    <?php 
    // Example #1, output into a div you already created
    echo Lava::render('PieChart', 'tablesPieChart', 'tablezChart'); 
    ?>
<!--    @foreach($results as $item)

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

@endforeach-->

@stop