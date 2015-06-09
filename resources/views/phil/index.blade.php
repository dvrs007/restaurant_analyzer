@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('maintitle')
Server Statistics - Restaurant Analyzer
@stop

@section('sidebar')
    
@stop

@section('content')
<div id="guyContainer">
    
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

    
    <div class="main-graph-title">
    <h2>Data Analysis by Table</h2>
    </div>
    <div class="col-md-12">
    
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
            
            

@stop