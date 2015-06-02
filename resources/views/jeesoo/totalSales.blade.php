@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><br/>
@stop

@section('content')
<hr/>
<h1>TOTAL SALES ($) over the years, months, .......</h1>
<hr/><br/><h1>{{ $var  }}</h1>


 <div id="chart_div"></div>
<?php
    //echo Lava::render('ColumnChart', 'TotalSales', 'chart_div');
    //  ?>
    
    
@columnchart('TotalSales','chart_div')
   
@stop