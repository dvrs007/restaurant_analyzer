
@extends('layouts.master')
{{--
@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1>
@stop


@section('content')

<div id='stocks-div'></div>
<?php //echo Lava::render('LineChart','Stocks','stocks-div'); ?>

@linechart('Stocks','stocks-div')
@stop
--}}

<div id='stocks-div'></div>
<?php echo Lava::render('LineChart','Stocks','stocks-div'); ?>

@linechart('Stocks','stocks-div')