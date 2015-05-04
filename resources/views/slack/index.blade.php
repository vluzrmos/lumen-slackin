@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2" >
            <div id="status" >
                {!!trans_choice('slackin.users_online', $totals['active'], $totals)!!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var $ = jQuery.noConflict();

    var pusher = new Pusher("{{config('pusher.connections.main.app_id')}}", {
        wsHost: "{{config('pusher.connections.main.wsHost')}}",
        wsPort: "{{config('pusher.connections.main.wsPort')}}",
        wssHost: "{{config('pusher.connections.main.wsHost')}}",
        wssPort: "{{config('pusher.connections.main.wsPort')}}",
        enabledTransports: ['ws', 'flash']
    });

    var channel = pusher.subscribe('local');

    var app = {
        Listeners:{},
        Messages:{
            messages:[],
            whenPushedMessage:function(messages){
                $('#messages').html(messages.length);
            },
            push:function(str){
                this.messages.push(str);
                this.whenPushedMessage(this.messages);
            }
        }
    };

    app.Listeners.Messages = {
        whenMessageSent: function(data){
            app.Messages.push(data.message);
        }
    };

    app.Listeners.UsersActivity = {
        whenActivity: function(data){
            $('.users-online').html(data.active);
            $('.users-total').html(data.total);
        }
    };

    channel.bind('MessageSent', app.Listeners.Messages.whenMessageSent);
    channel.bind('UsersActivity', app.Listeners.UsersActivity.whenActivity);

</script>
@endsection
