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

    <div id="poll_div"></div>
    <?php echo Lava::render('PieChart', 'NetRevenue_highestNet', 'poll_div') ?>
    
    <hr />
    
    <div id="poll_div2"></div>
    <?php echo Lava::render('PieChart', 'NetRevenue_lowestNet', 'poll_div2') ?>
    
    
@stop