<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Laravel Social and Email Authentication</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('/assets/plugins/bootstrap/dist/css/bootstrap.min.css') !!}

    <!-- Custom styles for this template -->
    {!! Html::style('/assets/css/navbar-static-top.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('head')

</head>

<body>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Social Authentication</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('public.home')  }}">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::check())
                <li><a href="{{ route('auth.login') }}">Login</a></li>
                <li><a href="{{ route('auth.register') }}">Register</a></li>
                @else
                <li><a href="#">{{ Auth::user()->first_name }}</a></li>
                <li><a href="{{ route('authenticated.logout') }}">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container">

    @yield('content')

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
{!! Html::script('/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{!! Html::script('/assets/js/ie10-viewport-bug-workaround.js') !!}

@yield('footer');
</body>
</html>