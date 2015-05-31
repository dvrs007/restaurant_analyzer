<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('js/order.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/angular.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </head>
    <body>
        <div id="wrap">
            <div class="container">
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
                            <a class="navbar-brand" href="#">Order.Eat.Repeat</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                              <li><a href="#">Menu</a></li>
                              <li><a href="#">Orders</a></li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Statistics <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Sales</a></li>
                                </ul>
                              </li>
                            </ul>
                          </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </header>

                <div id="main">
                    <div class="row">
                        <div class="img-container">
                            <img src="images/cafe_main_pic.jpg" alt="" />
                        </div
                    </div>
                    <div class="container-fluid">
                        <h2>@yield('maintitle')</h2>
                        @section('sidebar')
                        This is the master sidebar.
                        @show

                        @yield('content')
                    </div>
                </div>
            </div>
            <div id="footer">
                <div class="container-fluid">
                    <div class="col-sm-5 col-md-6">Footer Item</div>
                    <div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">Footer Item</div>
                    <div class="col-lg-8">
                        <p>Copyright &copy; <?php echo date("Y"); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- jQuery -->
        <script src="../public/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../public/js/bootstrap.min.js"></script>
    </body>
</html>
