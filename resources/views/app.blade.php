<!doctype html>
<html lang="{{app('translator')->locale()}}">

<head>
    <meta charset="UTF-8">
    <title>@if($team['name']){{$team['name']}}@else{{'Lumen Slackin'}}@endif</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if($team['icon'])
        <link rel="icon" href="{{$team['icon']['image_132']}}"/>
    @endif

    @if(app()->environment()=='local')
        <script type="text/javascript" src="{{url('js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{url('js/socket.io.js')}}"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('css/bootstrap-theme.css')}}">

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('js/bootstrap.js')}}"></script>
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
        <script type="text/javascript">Lang.setLocale("{{app('translator')->locale()}}");</script>
        <script type="text/javascript" src="{{url('js/app.js')}}"></script>
    @else
        <link rel="stylesheet" href="{{url(elixir('css/all.css'))}}"/>

        <script type="text/javascript" src="{{url(elixir('js/all.js'))}}"></script>

        <script type="text/javascript">
            var app = app||{};
            app.config = app.config||{};

            app.config.debug = Number.parseInt("{{env('APP_DEBUG')}}");
            app.config.websocket = {
                host: "{{env('WS_HOST')}}"||window.location.hostname,
                port: "{{env('WS_PORT')}}"||'8080'
            };
        </script>
        <script type="text/javascript">Lang.setLocale("{{app('translator')->locale()}}");</script>
        <script type="text/javascript" src="{{url(elixir('js/app.min.js'))}}"></script>
    @endif

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

