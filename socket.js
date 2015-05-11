var app   = require('express');
var http  = require('http').Server(app);
var io    = require('socket.io')(http);
var exec  = require('exec');

require('dotenv').load();

var Redis = require('ioredis');

var redis = new Redis('redis://127.0.0.1:6379/0');

redis.subscribe('local', function(err, count){

});

redis.on('message', function(channel, message){
	message = JSON.parse(message);

	io.emit(channel+':'+message.event, message.payload);
});


http.listen(process.env.WS_PORT, function(){
	// console.log('Listen on 0.0.0.0:8080');
});

// Exec as cronjob every (x) seconds
setInterval(function(){
    exec('php artisan slack:status', function(err, out, code) {
        if (err instanceof Error){
            process.stderr.write(err);
        }
    });
}, process.env.SLACK_STATUS_INTERVAL || 3000);

// Exec queue work
exec('php artisan queue:work --daemon', function(err, out, code) {
    if (err instanceof Error){
        process.stderr.write(err);
    }
});
