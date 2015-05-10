<!doctype html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <title>@if($team['name']){{$team['name']}}@else{{'Lumen Slackin'}}@endif</title>

    @if($team['icon'])
        <link rel="icon" href="{{$team['icon']['image_132']}}"/>
    @endif

    @if(app()->environment('local'))
        <script type="text/javascript" src="{{url('js/jquery-2.1.4.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/socket.io-1.3.5.js')}}"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('js/bootstrap.min.js')}}"></script>
    @else
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="//cdn.socket.io/socket.io-1.3.5.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    @endif

    <link rel="stylesheet" href="{{url('css/app.css')}}"/>

    <script type="text/javascript" src="{{url('js/messages.js')}}"></script>
    <script type="text/javascript">Lang.setLocale('{{config('app.locale')}}');</script>
    <script type="text/javascript" src="{{url('js/app.js')}}"></script>
    <script type="text/javascript">
        app.config.debug = Number.parseInt('{{env('APP_DEBUG')}}');
    </script>
</head>
<body>
    @yield('content')

    <div id="footer">
        Made with <i class="glyphicon glyphicon-heart" style="color: red;"></i> by <a href="https://github.com/vluzrmos" target="_blank">Vluzrmos</a> + <a href="http://lumen.laravel.com" target="_blank">Lumen Framework</a>, fork me on <a href="https://github.com/vluzrmos/lumen-slackin" target="_blank">Github</a>.
    </div>
</body>
</html>

