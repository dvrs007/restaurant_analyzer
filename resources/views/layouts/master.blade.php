<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="wrap">
        <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Story</a></li>
            <li role="presentation"><a href="#">Gallery</a></li>
        </ul>
        <h2>@yield('maintitle')</h2>
        @section('sidebar')
            This is the master sidebar.
        @show

            @yield('content')
        </div>
        <div id="footer">
            <div class="container">
                <div class="col-md-4">Footer Item</div>
                <div class="col-md-4">Footer Item</div>
                <div class="col-md-4">Footer Item</div>
            </div>
        </div>
        </div>
    </body>
</html>

