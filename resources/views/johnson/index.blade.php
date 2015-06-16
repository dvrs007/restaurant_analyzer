@extends('layouts.master')

@section('title')
Item Analysis
@stop

@section('maintitle')
Item Statistics - Restaurant Analyzer
@stop
    
@section('content')
<div class="main-title"><h2>Item Statistics</h2></div>
<div class="row">
    <div class="col-lg-10 center-block">
        <div class="main-graph-title">
            <h2>General Product Statistics</h2>
        </div>
        
        <div class="tabs">
        <ul class="tab-links">
            <li class="active"><a href="#tab1">General Item Statistics</a></li>
            <li><a href="#tab3">Item Charts</a></li>
        </ul>
            
        <div class="tab-content">
            <div id="tab1" class="tab active">
                <div class="col-md-6">
                    <div class="main-title"><h4>Information</h4></div>
                    <ul>
                        <li>Statistics on the sales of <span style="color:#0000C2;">{{ $itemcount }}</span> items</li>
                        <li>Total items ordered: <span style="color:#0000C2;">{{ $itemOrders }}</span></li>
                        <li>Total made: <span style="color:#0000C2;"> ${{ $totalGen }} </span></li>
                        <li><h3 style="color:green;">The highest grossing item is {{ $high_gross_item }}</h3></li>
                        <li id="warning" class="animated infinite shake"><h3 style="color:red;">Oh no! {{ $low_gross_item }} is not doing well!</h3></li>
                    </ul>
                </div>
            </div>
        
        <div id="tab2" class="tab"></div>
            
        <div id="tab3" class="tab">
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
        </div>
    </div>
    </div>
    </div>
</div>
@stop