<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
        <link href='http://fonts.googleapis.com/css?family=Allan:400,700' rel='stylesheet' type='text/css'>

        
        <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('js/order.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
        
    </head>
    <body>
        <div id="wrap">
            <!--<div class="container">-->
            <header>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ url('/') }}">Order.Analyze.Repeat.</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('menus') }}">Menu</a></li>                              
                                <li><a href="{{ url('orders') }}">Orders</a></li>
                                <li class="dropdown">
                                    <a href class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Statistics <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('item-sales') }}">Item</a></li>
                                        <li><a href="{{url('server-stats')}}">Servers</a></li>
                                        <li><a href="{{url('totalSales')}}">Total Sales</a></li>
                                    </ul>
                                    </div><!-- /.navbar-collapse -->
                                    </div><!-- /.container-fluid -->
                                    </nav>
                                    </header>
            
                                    <div id="main">
                                        <div class="row">

                                            <div class="container-fluid">
                                                @yield('content')
                                            </div>
                                        </div>
                                    </div>
                                    <div id="footer">
                                        <div class="container-fluid">
                                            <div class="col-sm-4">
                                                <h4 class="footer-title">Orders</h4>
                                                <p><a href="{{ url('orders') }}">View All</a></p>
                                                <p><a href="{{url('orders/create')}}">Add New</a></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <h4 class="footer-title">Menu</h4>
                                                <p><a href="{{ url('menus') }}">Current Menu</a></p>
                                                <p><a href="{{url('menus/create')}}">Add Item</a></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <h4 class="footer-title">Statistics</h4>
                                                <p><a href="{{ url('item-sales') }}">Menu Items</a></p>
                                                <p><a href="{{url('server-stats')}}">Servers &amp; Tables</a></p>
                                                <p><a href="{{url('totalSales')}}">Total Sales</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--</div>-->
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
                    $( ".arrow-container" ).fadeIn( 700, function() {
                    // Animation complete
                    });
                }
                else
                {
                    $( ".arrow-container" ).fadeOut( 700, function() {
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
            
                                    <!-- jQuery -->
                                    <script src="../public/js/jquery.js"></script>

                                    <!-- Bootstrap Core JavaScript -->
                                    <script src="../public/js/bootstrap.min.js"></script>
                                    </body>
                                    </html>
