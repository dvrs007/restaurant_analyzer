@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('maintitle')
Restaurant Analyzer
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
                <h2>Individual Server Statistics</h2>
                <label for="servers">Select a Server: </label>
                <select id="servers">
                    <option>Server Name </option>
                </select>
            </div>
    
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
            
            <div class="arrow-container">
                <div class="arrow-up"></div>
            </div>
            
            <script type="text/javascript">
            //ARROW SCROLLER
            // show arrow if user has scrolled down, or hide if at top
            $(window).scroll(function() {
                

                var height = $(window).scrollTop();
                
                if(height > 0)
                {
                    $( ".arrow-container" ).fadeIn( 2000, function() {
                    // Animation complete
                    });
                }
                else
                {
                    $( ".arrow-container" ).fadeOut( 2000, function() {
                    // Animation complete
                    });
                }
            });
            
            
            //scroll to top of page if arrow clicked
            $(".arrow-container").click(function () {
            
                $('html,body').animate({
                    
                scrollTop: $("html,body").offset().top
                });
            
            });
            //END ARROW SCROLLER
           
            </script>

@stop