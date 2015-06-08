@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><br/>
@stop

@section('content')
<hr/>

<!-- *********** YEAR *************** -->
<h2>Sales Performance ($) over the years 2000-2014</h2>
<br/>
<div id="chart_year_avg"></div>
@columnchart('AverageSalesY','chart_year_avg')

<div style='border:thin dashed 2px;'></div>

<div id="chart_year_amt"></div>
@combochart('TotalSalesY','chart_year_amt')

<div style='border:thin dashed 2px;'></div>

<div id='chart_year_cnt'></div>
@areachart('TotalNumberY','chart_year_cnt')

<div style='border:double 2px;'></div>

<!--*********** MONTH ***************** -->
<h2>Sales Performance ($) in each month over the years 2000-2014</h2>
<br/>


<div id='chart_month_amt'></div>
@columnchart('TotalSalesM','chart_month_amt')

<div style='border:thin dashed 2px;'></div>

<!--div id='chart_month_cnt'></div-->
{{--@columnchart('TotalCountM','chart_month_cnt')--}}

<div style='border:thin dashed 2px;'></div>
<br/>


@for($i=0; $i < 15 ; $i++)
<button type="button" id="year_<?php echo 2000 + $i; ?>">{{ 2000 + $i}}</button>
@endfor

<div id="per_year" style="display:none;">
    <div id='chart_month_amt_2000'></div>
    @columnchart('TotalSalesM2000','chart_month_amt_2000')
</div>


<br/><br/>
<div style='border:thin dashed 2px;'></div>

<!--div id='chart_month_cnt_2000'></div-->
{{--@columnchart('TotalCountM2000','chart_month_cnt_2000')--}}

<div style='border:double 2px;'></div>
<!-- DAY-->
<div id="chart_day_amt"></div>
@columnchart('TotalSalesD','chart_day_amt')



<!-- div id="colchart_div"></div -->
<?php
//echo Lava::render('ColumnChart', 'TotalSales', 'chart_div');
//  
?>   
{{-- columnchart('TotalSales','colchart_div')--}}

<br/>
<!-- div id='linechart-div'></div-->
<?php //echo Lava::render('LineChart','Stocks','stocks-div');  ?>

{{-- @linechart('TotalSales','linechart-div') --}}



<script>
    $(document).ready(function () {


        $('#year_2000').on('click', function () {
            $('#per_year').toggle();
        });

    });
</script>


@stop