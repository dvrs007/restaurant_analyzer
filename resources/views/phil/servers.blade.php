@extends('layouts.master')

@section('title')
Server Analysis
@stop

@section('maintitle')
Server Statistics - Restaurant Analyzer
@stop

@section('sidebar')
    
@stop

@section('content')
<div id="guyContainer">
    
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