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

    <link rel="stylesheet" href="{{url(elixir('css/all.css'))}}"/>

    <script type="text/javascript" src="{{url(elixir('js/all.js'))}}"></script>

    <script type="text/javascript">
        var app = app||{};
        app.config = app.config||{};

        app.config.debug = Number.parseInt("{{env('APP_DEBUG')}}");
    </script>

    <script type="text/javascript" src="{{url(elixir('js/app.min.js'))}}"></script>

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
