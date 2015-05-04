<!doctype html>
<html lang="{{config('locale')}}">

<head>
    <meta charset="UTF-8">
    <title> Lumen Slackin </title>
    @if(App::environment('local'))
        <script src="{{url('js/jquery-2.1.4.min.js')}}"></script>

        <script src="{{url('js/pusher.min.js')}}"></script>
    @else
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

        <script src="//js.pusher.com/2.2/pusher.min.js"></script>
    @endif
</head>
<body>
    @yield('content')
</body>
</html>

