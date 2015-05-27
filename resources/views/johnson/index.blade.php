@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Sales Chart

@stop

@section('sidebar')
    

    <p>Welcome to the JOHNSON Page</p>
    <div id="temps_div"></div>
    <?php echo Lava::render('LineChart', 'Temps', 'temps_div') ?>

    @linechart('Temps', 'temps_div')
    
    @foreach($order as $ord)
 
    <h3>{{ $ord->item_name }}</h3>

    @endforeach
    
@stop

@section('content')
    <p>This is a website built using Laravel, PHP, and Bootstrap. It's very basic right now and doesn't really do anything, but soon I will connect a database to it and it will be totally mind-boggling.</p>
@stop