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
            console.log(data);

            $('.users-online').html(data.active);
            $('.users-total').html(data.total);
        }
    };

    var socket = io('http://localhost:8080');

    socket.on('local:MessageSent', app.Listeners.Messages.whenMessageSent);
    socket.on('local:UsersActivity', app.Listeners.UsersActivity.whenActivity);

</script>
@endsection
