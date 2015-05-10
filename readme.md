## Lumen - Slackin

[![Latest Stable Version](https://poser.pugx.org/vluzrmos/lumen-slackin/v/stable)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![Total Downloads](https://poser.pugx.org/vluzrmos/lumen-slackin/downloads)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![License](https://poser.pugx.org/vluzrmos/lumen-slackin/license)](https://packagist.org/packages/vluzrmos/lumen-slackin)

A Slack Invitator made with Lumen Framework and inspired by [rauchg/slackin](https://github.com/rauchg/slackin).

## Download the source

```bash
composer create-project vluzrmos/lumen-slackin
```

## Dependencies

That package uses [Lumen Socketio](https://github.com/vluzrmos/lumen-socketio), then you have to install nodejs and that dependencies:

```bash
npm install --save express http-server redis ioredis socket.io
```

To run the socket.io server in background, I recommend you the package [Forever](https://www.npmjs.com/package/forever):

```bash
npm install -g forever
```

And your have to install [Redis](http://redis.io/), on linux distros: 

```bash
sudo apt-get install redis-server
```

## Instalation

Copy <code>.env.example</code> to <code>.env</code> and:

Change the <code>APP_KEY</code> to something random string with max 32 characters.

Change the <code>SLACK_TOKEN</code> to the token of your user on slack team, with admin privilegies, you can get it on [Slack Web API](https://api.slack.com/web#authentication).

## Run

Start the socket.io server:

```bash
forever start socket.js
```

The socket.io server will run at localhost:8080, if you need to modify it, just change it on <code>socket.js</code> and <code>public/js/app.js</code> files.

Start the http server:

```bash
php artisan serve
```

By default, artisan serve starts on port 8000, 
if you want to modify it, just starts it by passing <code>--port=NUMBER</code> or 
just make a VirtualHost on your server (Apache or Nginx) with DocumentRoot on 
<code>/path/to/that/project/public/</code> path.

## License

[DBAD](http://www.dbad-license.org/).
