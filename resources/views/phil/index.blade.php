@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('content')
<div class="main-title"><h2><img class="server-icon" src="{{asset('images/people.png')}}">Server &amp; Table Statistics</h2></div>
<div id="guyContainer">
    <div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1">General Server Statistics</a></li>
        <li><a href="#tab2">Individual Server Statistics</a></li>
        <li><a href="#tab3">Table Statistics</a></li>
    </ul>
 
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <div class="main-graph-title">
                <h2>General Server Statistics</h2>
            </div>

                <h4>Currently, a total <span class="blue">{{ $serverscount}}</span> of servers have taken orders.</h4>

            
            <div class="graph-title">
                <h3>Sales Performance by Server</h3>
            </div>

            <!--chart code -->
            <div id="myStocks"></div>
            <?php 
            // Example #1, output into a div you already created
                echo Lava::render('BarChart', 'myFancyChart', 'myStocks'); 
            ?>
            <div class="graph-title">
                <h3>Items Quantity by Server</h3>
            </div>

            <!--chart code -->
            <div id="quantities"></div>
            <?php 
            // Example #1, output into a div you already created
                echo Lava::render('BarChart', 'quantitiezChart', 'quantities'); 
            ?>
        </div>
 
        <div id="tab2" class="tab">
            <div class="main-graph-title">
                <h2>Individual Server Statistics</h2>
            </div>
            <div class="col-md-12">
                <div class="main-title">
                    <h2>Current Servers</h2>
                </div>
                @foreach($allservers as $server)
                <div class="col-md-4">
                    
                    <h2>{{ $server->server_firstname }} {{$server->server_lastname }}</h2>
                    
                    <img class="server-image" src="{{ $server->server_pic }}" alt="server">
                    </div>
                @endforeach
            </div>
            <div class="col-md-12">
                <h2 class="main-title">Select a server to view his/her stats: </h2>
            {!! Form:: open( ['url' => 'serverResults']) !!} 
            <select class="server-select" name="server_select">
                @foreach($allservers as $s)
                <option id="" value="{{ $s->id }}">{{ $s->server_firstname }} {{ $s->server_lastname }}</option>
                @endforeach
            </select>  
            {!! Form::submit('View Stats', ['class' => 'btn btn-primary form-control']) !!}
            {!! Form:: close() !!}
                
            </div>
        </div>
 
        <div id="tab3" class="tab">
            <div class="main-graph-title">
                <h2>Data Analysis by Table</h2>
            </div>
            <div class="col-md-6">
                <div class="main-title"><h4>Best &amp; Worst Tables</h4></div>
                <div class="col-md-6">
                <h2 class="green">Highest Grossing Table:</h2> <br>
                <img src="{{asset('images/table.png')}}" class="server-icon" alt="table icon">
                <h4>
                    @foreach($highesttable as $t)
                    Table #<span class="blue">{{$t->tbl_number}}</span> <br> $<span class="blue">{{$t->subtotal}}</span> in total sales.
                    @endforeach
                    
            </h4>
            </div>
                <div class="col-md-6">
                <h2 class="red">Lowest Grossing Table:</h2><br>
                <img src="{{asset('images/table.png')}}" class="server-icon" alt="table icon">
                <h4>
                @foreach($lowesttable as $t)
                Table #<span class="blue">{{$t->tbl_number}}</span> <br> $<span class="blue">{{$t->subtotal}}</span> in total sales.
                @endforeach
            </h4>
                
            </div>
                <div class="col-md-12">
                    <h2>Average  Gross Income Per Table Order:</h2>
                <img src="{{asset('images/table.png')}}" class="server-icon" alt="table icon">
                <h2>$ <?php foreach($avgtable as $a){ echo number_format($a->average, 2); } ?></h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-title"><h4>Tables By Items</h4></div>
                <div class="table-responsive server-items sortable">
                    <table class="table table-striped">
    <tr>
        <th>Table Number</th>
        <th>Quantity of Items Sold</th>
    </tr>

<?php
foreach($tblitems as $b){
    echo '<tr><td>' . $b->tbl_number . '</td>';
    echo '<td>' . $b->quantity . '</td></tr>';
}
?>
</table>
                </div>
            </div>
            <div class="clearfix"></div>
                <div class="graph-title">
                    <h3>Sales Performance by Table</h3>
                </div>

                <!--chart code -->
                <div id="tablezChart"></div>
    
                <?php 
                // Example #1, output into a div you already created
                echo Lava::render('PieChart', 'tablesPieChart', 'tablezChart'); 
                ?>
        </div>
    </div>
</div>
    
</div>
@stop