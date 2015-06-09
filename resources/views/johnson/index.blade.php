@extends('layouts.master')
    
@section('content')

        <h1>General Item Statistics</h1>
        <ul>
            <li>Statistics on the sales of <span style="color:#0000C2;">{{ $itemcount }}</span> items</li>
            <li>Total items ordered: <span style="color:#0000C2;">{{ $itemOrders }}</span></li>
            <li>Total made: <span style="color:#0000C2;"> ${{ $totalGen }} </span></li>
        </ul>
        <hr />
<div class="col-sm-5 col-md-6">
    <div class="row">
        <h3>The highest grossing item is: {{ $high_gross_item }}</h3>
        <button id="positive_stats">Show positive charts</button>

        <div id="positive_charts">
            <div id="poll_div"></div>
            <?php echo Lava::render('PieChart', 'NetRevenue_highestNet', 'poll_div') ?>
            
            <div id="perf_div"></div>
            <?php echo Lava::render('ColumnChart', 'OrderedQuantity', 'perf_div') ?>
        </div>
    </div>
</div>

<div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
    <div class="row">
        <h3>Oh no! {{ $low_gross_item }} is not doing well!</h3>
        <button id="negative_stats">Show negative charts</button>

        <div id="negative_charts">
            <div id="poll_div2"></div>
            <?php echo Lava::render('PieChart', 'NetRevenue_lowestNet', 'poll_div2') ?>
        </div>
    </div>
</div>
    
@stop