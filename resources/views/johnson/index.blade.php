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