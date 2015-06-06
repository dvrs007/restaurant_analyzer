@extends('layouts.master')
    
@section('content')

<div class="col-sm-5 col-md-6">
    <div class="row">
        <ul>
            <li>Statistics on the sales of {{ $itemcount }} items</li>
            <li>Total items ordered: {{ $itemOrders }}</li>
            <li>Total made: ${{ $totalGen }}</li>
        </ul>
        <button id="positive_stats">Show positive charts</button>

        <div id="positive_charts">
            <div id="poll_div"></div>
            <?php echo Lava::render('PieChart', 'NetRevenue_highestNet', 'poll_div') ?>
        </div>
    </div>
</div>

<div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
    <div class="row">
        <h3>Oh no! </h3>
        <button id="negative_stats">Show negative charts</button>

        <div id="negative_charts">
            <div id="poll_div2"></div>
            <?php echo Lava::render('PieChart', 'NetRevenue_lowestNet', 'poll_div2') ?>
        </div>
    </div>
</div>
    
@stop