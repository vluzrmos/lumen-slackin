## Lumen - Slackin

[![Latest Stable Version](https://poser.pugx.org/vluzrmos/lumen-slackin/v/stable)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![Total Downloads](https://poser.pugx.org/vluzrmos/lumen-slackin/downloads)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![License](https://poser.pugx.org/vluzrmos/lumen-slackin/license)](https://packagist.org/packages/vluzrmos/lumen-slackin)

A Slack Invitator made with Lumen Framework and inspired by [rauchg/slackin](https://github.com/rauchg/slackin).

## Download the source

```bash
composer create-project vluzrmos/lumen-slackin
```

## Dependencies

That package uses [NodeJS](https://nodejs.org/) modules, 
download it on [https://nodejs.org/](https://nodejs.org/) and install, 
then you have to install nodejs dependencies:

```bash
# Installing global dependencies (with super-user, root, or administrator priviligies)
npm install -g gulp forever
```

```bash
# Installing local dependencies described on packages.json file
npm install
```

And you have to install [Redis](http://redis.io/), for Real Time count users. On linux distros: 

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

The socket.io server will run at localhost:8080, if you need to modify it, just change it on your <code>.env</code> file <code>WS_PORT</code> and <code>WS_HOST</code>.

> That will also check  updates of your team status every 3000 ms (3 seconds), modify it on socket.js if you want. 

Compile the assets (css and javascript files):

```bash
gulp --production
```
> Without that, if your application is in production mode (APP_ENV=production on .env file), some errors will occurs. 

Start the http server:

```bash
php artisan serve
```

By default, artisan serve starts on port 8000, 
if you want to modify it, just starts it by passing <code>--port=NUMBER</code> or 
just make a VirtualHost on your server (Apache or Nginx) with DocumentRoot on 
<code>/path/to/that/project/public/</code> path.

## Multi-Language Support

By default the system will try to detect if the browser language is available on <code>resources/lang</code>, 
if available will setup. Available languages:

* en
* pt-br

## Mobile Devices

That project uses [Twitter Bootstrap 3](http://getbootstrap.com), and it is compatible on small devices.

## License

[DBAD](http://www.dbad-license.org/).
