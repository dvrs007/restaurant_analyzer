@extends('layouts.master')

@section('title')
Total sales ($) Analyzer
@stop

@section('maintitle')
Trends Analysis of Total Sales ($) over the years 2000-2014
@stop

@section('content')
<div class="main-title"><h2>Trends Analysis of Gross Amount ($) of Sales over the years 2000-2014</h2></div>
<div class="row">
    <div class="col-lg-10 center-block">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist" >
                <li role="presentation" class="active"><a href="#year" aria-controls="year" role="tab" data-toggle="pill">Yearly Performance</a></li>
                <li role="presentation" ><a href="#month" aria-controls="month" role="tab" data-toggle="pill">Monthly Performance</a></li>
                <li role="presentation" ><a href="#day" aria-controls="day" role="tab" data-toggle="pill">Daily Performance</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="year">

                    <!-- *********** YEAR *************** -->
                    <h2>Gross Sales Performance in Each Year ($CAD) </h2>
                    <div id="chart_year_amt"></div>
                    @combochart('TotalSalesY','chart_year_amt')

                    <div style='border:thin dashed 2px;'></div>

                    <h2>Average Sales Performance Per Order in Each Year ($CAD) </h2>
                    <div id="chart_year_avg"></div>
                    @columnchart('AverageSalesY','chart_year_avg') 

                    <div style='border:thin dashed 2px;'></div>
                    
                    
                    
                    <h2>Total Number of Actual Sales Orders in Each Year ($CAD)</h2>
                    <div id='chart_year_cnt'></div>
                    @areachart('TotalNumberY','chart_year_cnt')

                    <!--div id='chart_year_cnt'></div-->
                    {{--@columnchart('TotalNumberY','chart_year_cnt')--}}


                </div><!-- /#year-->


                <div role="tabpanel" class="tab-pane fade" id="month">           
                    <!--*********** MONTH ***************** -->
                    <h2>Gross Sales Performance in each Month ($CAD) </h2>

                    <div id='chart_month_amt' style="width:100%;"></div>
                    @columnchart('TotalSalesM','chart_month_amt')

                    <div style='border:thin dashed 2px;'></div>

                    <!--div id='chart_month_cnt'></div-->
                    {{--@columnchart('TotalCountM','chart_month_cnt')--}}

                    <div style='border:thin dashed 2px;'></div>
                    <br/>
                    <!-- BUTTONS -------------------->
                    <div id="button_month" style="margin:0 auto;">
                        @for($i=0; $i < 15 ; $i++)
                        <button type="button" id="<?php echo 2000 + $i; ?>">{{ 2000 + $i}}</button>
                        @endfor
                    </div>
                    <!-- --------------------------->
                    <div id="per_year_2000" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2000'></div>
                        @columnchart('TotalSalesM2000','chart_month_amt_2000')
                    </div>

                    <div id="per_year_2001" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2001'></div>
                        @columnchart('TotalSalesM2001','chart_month_amt_2001')
                    </div>
                    <div id="per_year_2002" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2002'></div>
                        @columnchart('TotalSalesM2002','chart_month_amt_2002')
                    </div>
                    <div id="per_year_2003" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2003'></div>
                        @columnchart('TotalSalesM2003','chart_month_amt_2003')
                    </div>
                    <div id="per_year_2004" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2004'></div>
                        @columnchart('TotalSalesM2004','chart_month_amt_2004')
                    </div>
                    <div id="per_year_2005" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2005'></div>
                        @columnchart('TotalSalesM2005','chart_month_amt_2005')
                    </div>
                    <div id="per_year_2006" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2006'></div>
                        @columnchart('TotalSalesM2006','chart_month_amt_2006')
                    </div>
                    <div id="per_year_2007" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2007'></div>
                        @columnchart('TotalSalesM2007','chart_month_amt_2007')
                    </div>
                    <div id="per_year_2008" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2008'></div>
                        @columnchart('TotalSalesM2008','chart_month_amt_2008')
                    </div>
                    <div id="per_year_2009" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2009'></div>
                        @columnchart('TotalSalesM2009','chart_month_amt_2009')
                    </div>
                    <div id="per_year_2010" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2010'></div>
                        @columnchart('TotalSalesM2010','chart_month_amt_2010')
                    </div><div id="per_year_2011" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2011'></div>
                        @columnchart('TotalSalesM2011','chart_month_amt_2011')
                    </div><div id="per_year_2012" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2012'></div>
                        @columnchart('TotalSalesM2012','chart_month_amt_2012')
                    </div>
                    <div id="per_year_2013" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2013'></div>
                        @columnchart('TotalSalesM2013','chart_month_amt_2013')
                    </div>
                    <div id="per_year_2014" style="display:none;width:100%;float:left;">
                        <div id='chart_month_amt_2014'></div>
                        @columnchart('TotalSalesM2014','chart_month_amt_2014')
                    </div>



                    <div style="clear:both;"></div>
                    <br/><br/>
                    <div style='border:thin dashed 2px;'></div>

                    <!--div id='chart_month_cnt_2000'></div-->
                    {{--@columnchart('TotalCountM2000','chart_month_cnt_2000')--}}



                    <script>
                        $(document).ready(function () {
                            var div_id = new Array();

                            for (i = 0; i < 16; i++) {
                                div_id.push(document.getElementsByTagName("button")[i].getAttribute("id"));
                                console.log(div_id[i]);

                                switch (div_id[i])
                                {

                                    case '2000':
                                        $('#2000').on('click', function () {
                                            $('#per_year_2000').toggle();
                                        });
                                        break;
                                    case '2001':
                                        $('#2001').on('click', function () {
                                            $('#per_year_2001').toggle();
                                        });
                                        break;
                                    case '2002':
                                        $('#2002').on('click', function () {
                                            $('#per_year_2002').toggle();
                                        });
                                        break;
                                    case '2003':
                                        $('#2003').on('click', function () {
                                            $('#per_year_2003').toggle();
                                        });
                                        break;
                                    case '2004':
                                        $('#2004').on('click', function () {
                                            $('#per_year_2004').toggle();
                                        });
                                        break;
                                    case '2005':
                                        $('#2005').on('click', function () {
                                            $('#per_year_2005').toggle();
                                        });
                                        break;
                                    case '2006':
                                        $('#2006').on('click', function () {
                                            $('#per_year_2006').toggle();
                                        });
                                        break;
                                    case '2007':
                                        $('#2007').on('click', function () {
                                            $('#per_year_2007').toggle();
                                        });
                                        break;
                                    case '2008':
                                        $('#2008').on('click', function () {
                                            $('#per_year_2008').toggle();
                                        });
                                        break;
                                    case '2009':
                                        $('#2009').on('click', function () {
                                            $('#per_year_2009').toggle();
                                        });
                                        break;
                                    case '2010':
                                        $('#2010').on('click', function () {
                                            $('#per_year_2010').toggle();
                                        });
                                        break;
                                    case '2011':
                                        $('#2011').on('click', function () {
                                            $('#per_year_2011').toggle();
                                        });
                                        break;
                                    case '2012':
                                        $('#2012').on('click', function () {
                                            $('#per_year_2012').toggle();
                                        });
                                        break;
                                    case '2013':
                                        $('#2013').on('click', function () {
                                            $('#per_year_2013').toggle();
                                        });
                                        break;
                                    case '2014':
                                        $('#2014').on('click', function () {
                                            $('#per_year_2014').toggle();
                                        });
                                        break;
                                    default:

                                        break;
                                }
                            }


                        });
                    </script>
                </div><!-- /#month -->


                <div role="tabpanel" class="tab-pane fade" id="day">
                    <!-- DAY-->
                    <h2>Gross Sales Performance in each Day ($CAD)</h2>

                    <div id="chart_day_amt" style="width:100%;"></div>
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

                </div><!-- /#day -->

            </div><!-- /.tab-content -->
            <script>
                //dispatch event resize to trigger graph re-render
                $('a[data-toggle=tab').on('shown.bs.tab', function (e) {
                    window.dispatchEvent(new Event('resize'));
                });
            </script>
        </div><!--/tabpanel-->
</div>
</div>

@stop