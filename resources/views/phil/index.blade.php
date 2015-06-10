@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('maintitle')
Server Statistics
@stop

@section('content')
<div id="guyContainer">
    <script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
    </script>
    <div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1">General Server Statistics</a></li>
        <li><a href="#tab2">Individual Server Statistics</a></li>
        <li><a href="#tab3">Table Statistics</a></li>
    </ul>
 
    <div class="tab-content">
        <div id="tab1" class="tab active">
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
        </div>
 
        <div id="tab2" class="tab">
            <div class="main-graph-title">
                <h2>Individual Server Statistics</h2>
            </div>
            <form action="" method="post">
                <label for="servers">Select a Server: </label>
                <select id="servers">
                    <?php 
                    foreach($allservers as $server){
                        
                        echo "<option>" . $server->server . "</option>";
                        
                    }
                    ?>
                </select>
                <input type="submit" value="View Stats">
            </form>
                <div class="main-graph-title">
                    <h2>Current Servers:</h2>
                    <?php 
        
                    foreach($allservers as $server){
            
                        echo '<div class="col-md-4"><h3>' . $server->server . '</h3></div>';   
                } 
                    ?>
                </div>
        </div>
 
        <div id="tab3" class="tab">
            <div class="main-graph-title">
                <h2>Data Analysis by Table</h2>
            </div>
    
                <div class="graph-title">
                    <h3>Sales Performance by Table</h3>
                </div>

                <!--chart code -->
                <div id="tablezChart" style="width:100%;"></div>
    
                <?php 
                // Example #1, output into a div you already created
                echo Lava::render('PieChart', 'tablesPieChart', 'tablezChart'); 
                ?>
        </div>
    </div>
</div>
    
</div>

@stop