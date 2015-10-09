## Lumen - Slackin

[![Join the chat at https://gitter.im/vluzrmos/lumen-slackin](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/vluzrmos/lumen-slackin?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Latest Stable Version](https://poser.pugx.org/vluzrmos/lumen-slackin/v/stable)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![Total Downloads](https://poser.pugx.org/vluzrmos/lumen-slackin/downloads)](https://packagist.org/packages/vluzrmos/lumen-slackin) [![License](https://poser.pugx.org/vluzrmos/lumen-slackin/license)](https://packagist.org/packages/vluzrmos/lumen-slackin)

A Slack Invitator made with Lumen Framework and inspired by [rauchg/slackin](https://github.com/rauchg/slackin).

That application uses some of my awesome packages:

* [Badge Poser](https://github.com/vluzrmos/laravel-badge-poser) - Badges generator to Laravel.
* [Slack API](https://github.com/vluzrmos/laravel-slack-api) - Laravel easy Slack API.
* [Language Detector](https://github.com/vluzrmos/laravel-language-detector) - Automatic set the application language based on user browser preferences.
* [Lumen Tinker](https://github.com/vluzrmos/lumen-tinker) - An interactive shell to Lumen.

## Download the source

```bash
composer create-project vluzrmos/lumen-slackin
```

## Instalation

Copy <code>.env.example</code> to <code>.env</code> and:

Change the <code>APP_KEY</code> to something random string with max 32 characters.

Change the <code>SLACK_TOKEN</code> to the token of your user on slack team, with admin privilegies, you can get it on [Slack Web API](https://api.slack.com/web#authentication).

## Run

## Queue
Start the queue listener:

```bash
php artisan queue:listen --timeout=240 1>> /dev/null 2>&1 &
```

> That will start the queue listener in background on \*nix computers, to stop that you need to know
  how to kill a job on your system.

> Its hight recomended run the queue on system startup, on linux you should add the following lines to your crontab:

```bash
@reboot php /path/to/that/project/artisan queue:listen --timeout=240 1>> /dev/null 2>&1
```

### Scheduled Tasks (Optional)

You may also need to add that command to your cronjob, that will update the users status on every minute:

```bash
* * * * *  php /path/to/that/project/artisan schedule:run 1>> /dev/null 2>&1
```

That will make your queue run in background and ignoring error messages.

**Note:** If you do not want to use that feature, you just need to set the environment
variable `SLACK_STATUS_ENABLED` to `false` on your `.env` file, that will hide the message
about users active (online/total) of your team on the homepage:

    SLACK_STATUS_ENABLED=false

### HTTP Server

Start the http server:

```bash
php artisan serve
```

By default, artisan serve starts on port 8000, if you want to modify it, just starts it by passing <code>--port=NUMBER</code> or 
just make a VirtualHost on your server (Apache or Nginx) with DocumentRoot on <code>/path/to/that/project/public/</code> path.

## Badge is available

If your need a badge to your slack invitator, just use:

```html
<img src="http://your-domain/badge.svg" />
```

Example:
[![Laravel Brasil](http://slack.laravel.com.br/badge.svg)](http://slack.laravel.com.br)

## Multi-Language Support

By default the system will try to detect if the browser language is available on <code>resources/lang</code>, 
if available will setup. Available languages:

* en
* pt-br

## Mobile Devices

That project uses [Twitter Bootstrap 3](http://getbootstrap.com), and it is compatible on small devices.

## Using Lumen Slackin

Your team are using this project? Put your link here:

- [CakePHP Brasil](http://slack.cakephpbrasil.com.br/)
- [Laravel Brasil](http://slack.laravel.com.br)
- [VueSlack](http://vueslack.com)
- [Sencha Brasil](http://sencha-br.wemersonjanuario.com.br)

> Note: Consider to send a PR to master branch.

## License

[DBAD](http://www.dbad-license.org/).
