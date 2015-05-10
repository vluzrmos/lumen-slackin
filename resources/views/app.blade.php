<!doctype html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <title> Lumen Slackin </title>
    @if(app()->environment('local'))
        <script type="text/javascript" src="{{url('js/jquery-2.1.4.min.js')}}"></script>

        <script type="text/javascript" src="{{url('js/socket.io-1.3.5.js')}}"></script>
    @else
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>

        <script type="text/javascript" src="//cdn.socket.io/socket.io-1.3.5.js"></script>
    @endif

    <script type="text/javascript" src="{{url('js/messages.js')}}"></script>
    <script type="text/javascript">Lang.setLocale('{{config('app.locale')}}');</script>
</head>
<body>
    @yield('content')
</body>
</html>

