<!doctype html>
<html lang="{{config('locale')}}">

<head>
    <meta charset="UTF-8">
    <title> Lumen Slackin </title>

    @if(app()->environment('local'))
        <script src="{{url('js/jquery-2.1.4.min.js')}}"></script>

        <script src="{{url('js/socket.io-1.3.5.js')}}"></script>
    @else
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

        <script src="//cdn.socket.io/socket.io-1.3.5.js"></script>
    @endif
</head>
<body>

    <script type="text/javascript">
        var socket = io('http://localhost:8080');

        socket.on('channel:awesome-event', function (data) {
            console.log(data);
        });

    </script>
</body>
</html>


