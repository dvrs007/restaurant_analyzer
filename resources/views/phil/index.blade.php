@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Restaurant Analyzer

@stop

@section('sidebar')
    

    <p>Welcome to the About Page</p>
@stop

@section('content')
    <p>This is a website built using Laravel, PHP, and Bootstrap. It's very basic right now and doesn't really do anything, but soon I will connect a database to it and it will be totally mind-boggling.</p>
    
    <!--chart code -->
    <div id="myStocks"></div>
    
    <?php 
    // Example #1, output into a div you already created
    echo Lava::render('BarChart', 'myFancyChart', 'myStocks'); 
    ?>
    
    @foreach($results as $item)

<h3>
        
        {{ $item->server }}
        {{ $item->ordered_quantity }}
    
    </h3>

    <br>

@endforeach

@stop