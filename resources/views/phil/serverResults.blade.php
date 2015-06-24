@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('content')
<div id="container">
<div class="main-title"><h2><img class="server-icon" src="{{asset('images/people.png')}}">Individual Server Statistics</h2>
    <h5><a href="{{url('server-stats')}}">Back to Server Stats</a></div>
<div id="individual-container">
    <div class="col-md-6">
        @foreach($servername as $n)
        <img class="server-image" src="{{$n->server_pic}}" alt="{{$n->server_firstname}}">
            @endforeach
    </div>
    <div class="col-md-6">
        <hr>
        <h2> Currently viewing statistics of server:</h2>
        <h1><img class="server-icon" src="{{asset('images/people.png')}}"><span class="blue">@foreach($servername as $n){{ $n->server_firstname }} {{$n->server_lastname}}@endforeach</span></h1>

@foreach($serveritems as $i)
<h3>Total items sold: <span class="blue">{{$i->subtotal}}</span></h3>
@endforeach


<?php
//get total sales and format for canadian currency
foreach($servertotal as $i){
    $total = $i->subtotal;
    echo '<h3>Total sales amount: $ <span class="blue">'. $total .'</span></h3>';
}
?>


<?php 
//get average sale amount per table, format to two decimal places
foreach($serveravg as $i){

    $avg = number_format($i->subtotal, 2);

    echo '<h3>Average sale per table: $ <span class="blue">' . $avg . '</span></h3>';
}
?>

<hr>
<h2><img class="server-icon" src="{{asset('images/coffee.png')}}">Performance by Item(s)</h2>
<div class="table-responsive server-items sortable">
<table class="table table-striped">
    <tr>
        <th>Item Name</th>
        <th>Quantity Sold</th>
    </tr>

<?php
foreach($bestitem as $b){
    echo '<tr><td>' . $b->item_name . '</td>';
    echo '<td>' . $b->item_total . '</td></tr>';
}
?>
</table>
    </div>
    </div>
    
    </div>

<div class="col-md-12">
     <!--chart code -->
            <div id="myStocks"></div>
            <?php 
            // Example #1, output into a div you already created
                echo Lava::render('LineChart', 'myFancyChart', 'myStocks'); 
            ?>

</div>
    
    </div>
@stop
