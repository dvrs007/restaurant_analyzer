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
            <li><a href="#tab2">Item Charts</a></li>
        </ul>
            
        <div class="tab-content">
            <div id="tab1" class="tab active">
                <div class="col-md-6">
                    <h3 style="color:green;">The highest grossing item is {{ $high_gross_item }}</h3><img style="width:300px; border:8px solid #222;" src="{{url($high_gross_item_img)}}" />
                </div>
                    <div class="col-md-6 animated infinite shake" id="warning" >
                        <h3 style="color:red;">OH NO! {{ $low_gross_item }} is not doing well!</h3><img style="width:300px; border:8px solid #222;" src="{{url($low_gross_item_img)}}" />
                    </div> 
            </div>
            
        <div id="tab2" class="tab">
            Statistics on the sales of <span style="color:#0000C2;">{{ $itemcount }}</span> items
            <br />
            Total orders made: <span style="color:#0000C2;">{{ $itemOrders }}</span>
            <br />
            Total made before expenses: <span style="color:#0000C2;"> ${{ $totalGen }} </span>
            <br />
            Total expenses: <span style="color:red;"> ${{ $totalExp }} </span>
            <br />
            <p style="font-size: 1.5em;">Total profits: <span style="color:green;"> ${{ $totalGen - $totalExp }} </span></p>
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