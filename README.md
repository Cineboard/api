[![pipeline status](https://gitlab.com/cineboard/api/badges/master/pipeline.svg)](https://gitlab.com/cineboard/api/commits/master)

[![coverage report](https://gitlab.com/cineboard/api/badges/master/coverage.svg)](https://gitlab.com/cineboard/api/commits/master)


# Cineboard restful API

## Manage movie collections for you, family or friends.


### Application Components

- RESTful API [slim php framework](https://github.com/slimphp/Slim)
- WebGUI [AngularJS](https://github.com/angular/angular.js) and [Bootstrap](https://github.com/twbs/bootstrap)
- RDBMS [MariaDB 10.2](https://github.com/MariaDB/server)
  [If MySQL is used, use a version greater than 5.7 ]


### TO THE USERS

First: we need to clone both front/api repositories.
Then create database, a little help from the api repos (we suppose you have a mysql5.7+ db running).
Edit db.config and db_create.sh to customize configuration and then launch db_create.sh

`cd sql && bash db_create.sh`

Then copy src/settings.php to settings.local.php and customize.

To quickly use the application launch this command on both repositories:

`bash server-start-builtin.sh $PORT`

and browser to localhost:8080 to load webgui.


### TO THE DEVELOPERS and CONTRIBUTORS!

Important! Before to proceed check if php-xdebug is installed and running on your system to avoid errors

`php -r "echo (extension_loaded('xdebug') ? 'xdebug up and running!' : 'xdebug is not loaded!');"`


Check settings for debug => 'true'  and monolog level to Logger::INFO .

#### Check with PHPCS

`php vendor/bin/phpcs --standard=phpcs.xml src`


#### Check with PHPMD

`php vendor/bin/phpmd src text phpmd.xml`


#### Check with PHPMetrics

`php vendor/bin/phpmetrics --report-html=build/phpmetric-report src`


#### Run php unittests

`php vendor/bin/phpunit`


### Or use COMPOSER to do all

`composer run-script tests`


#### Launch with builtin php server

`bash server-start-builtin.sh 8081`


#### Launch with docker compose

```docker-compose up -d```


have fun and find a lot of bugs!
