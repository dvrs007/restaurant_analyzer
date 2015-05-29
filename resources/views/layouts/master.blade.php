<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <div id="wrap">
        <div class="container">
            
            <img class="main-photo" src="../public/images/cafe_main_pic.jpg" alt="" />
                
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
                    <a class="navbar-brand" href="#">Cafe</a>
                </div>
        
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"><a href="#">Menu</a></li>
                        <li role="presentation"><a href="#">Orders</a></li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Statistics <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Sales of Items</a></li>
                              <li><a href="#">Sales of Items</a></li>
                            </ul>
                        </li>
                    </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                </div><!-- /. navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            
            <div id="main" class="container clear-top">
                <h2>@yield('maintitle')</h2>
                @section('sidebar')
                    This is the master sidebar.
                @show

                    @yield('content')
            </div>
            <footer>
                <div class="container">
                    <div class="col-md-4">Footer Item</div>
                    <div class="col-md-4">Footer Item</div>
                    <div class="col-md-4">Footer Item</div>
                    <p>Copyright &copy; <?php echo date("Y"); ?></p>
                </div>
            </footer>
        </div><!--container-->
        </div><!--wrap-->
        
        <!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>
</html>

