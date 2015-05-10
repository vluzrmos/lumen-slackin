@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2" >
            <div>
                <div id="messages"></div>
            </div>
            <div id="status" >
                {!!trans_choice('slackin.users_online', $totals['active'], $totals)!!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var app = {
        config:{
            'debug': true
        },

        Listeners:{}
    };

    app.Listeners.UsersActivity = {
        whenActivity: function(data){
            if(app.config.debug){
                console.log(data);
            }

            $('#status').html(Lang.choice('slackin.users_online', data.active, data));
//            $('.users-online').html(data.active);
//            $('.users-total').html(data.total);
        }
    };

    var socket = io('http://localhost:8080');

    socket.on('local:UsersActivity', app.Listeners.UsersActivity.whenActivity);
</script>
@endsection
