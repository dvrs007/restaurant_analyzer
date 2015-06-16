@extends('layouts.master')
@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><br/>
@stop

@section('content')

<div class="row">
    <div class="col-lg-10 center-block">
        <div id='stocks-div'></div>
        <?php //echo Lava::render('LineChart','Stocks','stocks-div'); ?>

        @linechart('Stocks','stocks-div')
    </div>
</div>
@stop
