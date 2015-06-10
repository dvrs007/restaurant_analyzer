@extends('layouts.master')

@section('title')
Item Analysis
@stop

@section('maintitle')
Item Statistics - Restaurant Analyzer
@stop

@section('sidebar')
    
@stop
    
@section('content')

        <div class="main-graph-title">
            <h2>General Item Statistics</h2>
        </div>
        <ul>
            <li>Statistics on the sales of <span style="color:#0000C2;">{{ $itemcount }}</span> items</li>
            <li>Total items ordered: <span style="color:#0000C2;">{{ $itemOrders }}</span></li>
            <li>Total made: <span style="color:#0000C2;"> ${{ $totalGen }} </span></li>
            <li><h3 style="color:green;">The highest grossing item is {{ $high_gross_item }}</h3></li>
            <li><h3 style="color:red;">Oh no! {{ $low_gross_item }} is not doing well!</h3></li>
        </ul>
        <hr />
        
        <div id="chart-div"></div>
        <?php echo Lava::render('DonutChart', 'DonutChart', 'chart-div') ?>
        
        <hr />
        
        <div id="poll_div"></div>
        <?php echo Lava::render('PieChart', 'NetRevenue_highestNet', 'poll_div') ?>

        <hr />
        
        <div id="poll_div2"></div>
        <?php echo Lava::render('PieChart', 'NetRevenue_lowestNet', 'poll_div2') ?>

        <hr />

        <div id="perf_div"></div>
        <?php echo Lava::render('ColumnChart', 'OrderedQuantity', 'perf_div') ?>
    
@stop