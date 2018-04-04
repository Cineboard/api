# Cineboard restful API

## Manage movie collections for you, family or friends.

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


#### Launch with builtin php server

`bash server-start-builtin.sh 8081`


#### Launch with docker compose




have fun!
