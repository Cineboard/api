# Cineboard restful API

## Manage movie collections for you, family or friends.


### Application Components

- RESTful API [slim php framework](https://github.com/slimphp/Slim)
- WebGUI [AngularJS](https://github.com/angular/angular.js) and [Bootstrap](https://github.com/twbs/bootstrap)
- RDBMS [MariaDB 10.2](https://github.com/MariaDB/server)
  [if MySQL use a version superior to 5.7]


### TO THE USERS

First: we need to clone both front/api repositories.
Then create database, a little help from the api repos (we suppose you have a mysql5.7+ db running).
Edit db.config and db_create.sh to customize configuration and then launch db_create.sh

`cd sql && bash db_create.sh`

To quickly use the application launch this command on both repositories:

`bash server-start-builtin.sh`

and browser to localhost:8080 to load webgui.


### TO THE DEVELOPERS and CONTRIBUTORS!

Important! Before to proceed check if php-xdebug is installed and running on your system to avoid errors

`php -r "echo (extension_loaded('xdebug') ? 'xdebug up and running!' : 'xdebug is not loaded!');"`


#### Check with PHPCS

`php vendor/bin/phpcs --standard=phpcs.xml app`


#### Check with PHPMD

`php vendor/bin/phpmd app text phpmd.xml`


#### Check with PHPMetrics

`php vendor/bin/phpmetrics --report-html=build/phpmetric-report app`


#### Run php unittests

`php vendor/bin/phpunit`


### Or use COMPOSER to do all

`composer run-script tests`


#### Launch with builtin php server

`bash server-start-builtin.sh 8081`


#### Launch with docker compose




have fun!
