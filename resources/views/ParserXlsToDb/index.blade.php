<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle')</title>
    <link rel="stylesheet" href="{{ asset('/css/workers.css') }}">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- navBar -->

<div class="container">
    <div class="row">
        <div class="col-md-1 navHome">
                <a href="/">HOME</a>
        </div>
    </div>
</div>

<!-- content -->
<div class="container-fluid">
    @yield('content')
</div>


<!--workersJs-->
<script type="text/javascript" src="{{ URL::asset('js/workers.js') }}"></script>
</body>
</html>