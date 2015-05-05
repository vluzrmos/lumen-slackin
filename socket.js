var app   = require('express');
var http  = require('http').Server(app);
var io    = require('socket.io')(http);

var Redis = require('ioredis');

var redis = new Redis('redis://127.0.0.1:6379/0');

redis.subscribe('local', function(err, count){

});

redis.on('message', function(channel, message){
	message = JSON.parse(message);

	io.emit(channel+':'+message.event, message.payload);
});


http.listen(8080, function(){
	// console.log('Listen on 0.0.0.0:8080');
});

