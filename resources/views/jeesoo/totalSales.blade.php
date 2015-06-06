@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><br/>
@stop

@section('content')
<hr/>

<div id="chart_year_avg"></div>
@columnchart('AverageSalesY','chart_year_avg')


<div id="chart_year_amt"></div>
@columnchart('TotalSalesY','chart_year_amt')


<div style='border:double 5px;'></div>

<div id='chart_year_cnt'></div>
@columnchart('TotalNumberY','chart_year_cnt')
<div style='border:double 5px;'></div>

<div id='chart_month_amt'></div>
@columnchart('TotalSalesM','chart_month_amt')


<div style='border:double 5px;'></div>

<div id='chart_month_cnt'></div>
@columnchart('TotalCountM','chart_month_cnt')

<div id="chart_day_amt"></div>
@columnchart('TotalSalesD','chart_day_amt')



 <!-- div id="colchart_div"></div -->
<?php
    //echo Lava::render('ColumnChart', 'TotalSales', 'chart_div');
    //  ?>   
{{-- columnchart('TotalSales','colchart_div')--}}
   
<br/>
<!-- div id='linechart-div'></div-->
<?php //echo Lava::render('LineChart','Stocks','stocks-div'); ?>

{{-- @linechart('TotalSales','linechart-div') --}}

@stop