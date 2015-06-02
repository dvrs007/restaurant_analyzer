@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Sales Chart

@stop

@section('sidebar')

@stop
    
@section('content')
    <h1>Statistics on the sales of {{ $itemcount }} items</h1>
    <div id="chart-div"></div>
    
    <?php 
    
    echo Lava::render('PieChart', 'TotalSales', 'chart-div')  ?>
    
        @foreach($order as $item)
        <h3>Item Name: {{ $item->item_name }}<br />
            Item Price: {{ $item->item_price }}<br />
            Item Cost: {{ $item->item_cost }}<br />
            Profit: {{ $item->item_price - $item->item_cost }}</h3>
        @endforeach
            
    
@stop