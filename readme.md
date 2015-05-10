## Lumen - Slackin

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

To run the websocket server in background, I recommend you the package [Forever](https://www.npmjs.com/package/forever):

``bash
npm install -g forever
```

And your have to install [Redis](http://redis.io/), on linux distros: <code lang="bash">sudo apt-get install redis-server</code>.

## Instalation

Copy <code>.env.example</code> to <code>.env</code> and:

Change the <code>APP_KEY</code> to something random string with max 32 characters.
Change the <code>SLACK_TOKEN</code> to the token of your user on slack team, with admin privilegies, you can get it on [Slack Web API](https://api.slack.com/web#authentication).

## Run

```bash
    forever start socket.js
```

```bash
    php artisan serve
```

## License

[DBAD](http://www.dbad-license.org/).
