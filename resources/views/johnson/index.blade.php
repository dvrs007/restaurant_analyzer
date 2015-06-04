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
    <ul>
        <li>Statistics on the sales of {{ $itemcount }} items</li>
        <li>Total items ordered: {{ $itemOrders }}</li>
        <li>Total made: ${{ $totalGen }}</li>
    </ul>

    <div id="temps_div"></div>
<?php echo Lava::render('LineChart', 'Temps', 'temps_div') ?>
    
        @foreach($results as $item)
        <h3>Item Name: {{ $item->item_name }}<br />
            Item Price: {{ $item->item_price }}<br />
            Item Cost: {{ $item->item_cost }}<br />
            Profit: {{ $item->item_price - $item->item_cost }}</h3>
        @endforeach
            
    
@stop