<!doctype html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <title>@if($team['name']){{$team['name']}}@else{{'Lumen Slackin'}}@endif</title>

    @if($team['icon'])
        <link rel="icon" href="{{$team['icon']['image_132']}}"/>
    @endif

    @if(app()->environment()=='local')
        <script type="text/javascript" src="{{url('js/jquery-2.1.4.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/socket.io-1.3.5.js')}}"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" href="{{url('css/app.css')}}"/>

        <script type="text/javascript" src="{{url('js/messages.js')}}"></script>
        <script type="text/javascript">
            var app = app||{};
            app.config = app.config||{};

            app.config.debug = Number.parseInt('{{env('APP_DEBUG')}}');
            app.config.websocket = {
                host: '{{env('WS_HOST')}}'||window.location.hostname,
                port: '{{env('WS_PORT')}}'||'8080'
            };
        </script>
        <script type="text/javascript">Lang.setLocale('{{config('app.locale')}}');</script>
        <script type="text/javascript" src="{{url('js/app.js')}}"></script>
    @else
        <link rel="stylesheet" href="{{url('css/all.css')}}"/>

        <script type="text/javascript" src="{{url('js/vendor.js')}}"></script>

        <script type="text/javascript">
            var app = app||{};
            app.config = app.config||{};

            app.config.debug = Number.parseInt("{{env('APP_DEBUG')}}");
            app.config.websocket = {
                host: "{{env('WS_HOST')}}"||window.location.hostname,
                port: "{{env('WS_PORT')}}"||'8080'
            };
        </script>
        <script type="text/javascript">Lang.setLocale("{{config('app.locale')}}");</script>
        <script type="text/javascript" src="{{url('js/app.min.js')}}"></script>
    @endif
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <div id="footer">
        {!!trans('messages.copyright')!!}
    </div>
</body>
</html>

