[![pipeline status](https://gitlab.com/cineboard/api/badges/master/pipeline.svg)](https://gitlab.com/cineboard/api/commits/master)

[![coverage report](https://gitlab.com/cineboard/api/badges/master/coverage.svg)](https://gitlab.com/cineboard/api/commits/master)

![alt text](https://gitlab.com/cineboard/api/blob/master/Illustration/logo.png "Cineboard by AessE")

# Cineboard restful API

## Manage movie collections for you, family or friends.

### Try it now!
Check the Demo running on [firegarden.co](https://dash.cineboard.firegarden.co)

(thanks for support with free hosting man!!!)

Feedback are welcome!

### Application Components

- RESTful API [slim php framework](https://github.com/slimphp/Slim)
- Eloquent ORM [illumnate database](https://github.com/illuminate/database)
- WebGUI [AngularJS](https://github.com/angular/angular.js)
- RDBMS [MariaDB 10.1](https://github.com/MariaDB/server)


### TO THE USERS

First: we need to clone both front/api repositories.
Then create database, a little help from the api repos (we suppose you have a mysql5.7+ db running).
Edit db.config and db_create.sh to customize configuration and then launch db_create.sh

```console
$ cd sql && bash db_create.sh
```

Then copy src/settings.php to settings.local.php and customize.

To quickly use the application launch this command on both repositories:

```console
$ bash server-start-builtin.sh $PORT
```

and browser to localhost:8080 to load webgui.


### TO THE DEVELOPERS and CONTRIBUTORS!

Important! Before to proceed check if php-xdebug is installed and running on your system to avoid errors

```console
$ php -r "echo (extension_loaded('xdebug') ? 'xdebug up and running!' : 'xdebug is not loaded!');"
````

Check settings for debug => 'true'  and monolog level to Logger::DEBUG .

#### Check with PHPCS

```console
$ php vendor/bin/phpcs --standard=phpcs.xml src
```


#### Check with PHPMD

```console
$ php vendor/bin/phpmd src text phpmd.xml
```


#### Check with PHPMetrics

```console
$ php vendor/bin/phpmetrics --report-html=build/phpmetric-report src
```

#### Check with PHPstan [optional]

Warning! Due to incompatibilities with EloquenORM some false positive will be shown.

```console
$ php vendor/bin/phpstan analyse {-l $level} src
```

#### Run php unittests

```console
$ php vendor/bin/phpunit
```

#### Run unit/functional tests

Functional Tests with Guzzle configurated on port 8081 \
[TODO: use localhost with docker composed]

```console
$ bash server-start-builtin.sh 8081 &
$ php vendor/bin/phpunit --configuration phpunit_ci.xml
```

### Or use COMPOSER to do all

```console
$ composer run-script tests
```


#### Launch with builtin php server

```console
$ bash server-start-builtin.sh $PORT
```


## Docker Env

**ALMOST FINISHED**: Check Readme inside Docker/ directory.

## Authors

* **GB 'gionniboy' Pullarà** - [Firegarden](https://firegarden.co)


## Acknowledgments

Cineboard graphics&design by Alessia Sferrazza, used with permission.

## License
This project is licensed under the BSD 3-Clause License - see the [LICENSE](LICENSE) file for details


**have fun && bugs hunt && issue || PR !**

