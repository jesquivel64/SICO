#!/usr/bin/env bash
apt-get install php5-mcrypt php5-mysql php-apc mysql-server php5-gd php5-intl php5-mbstring
apt-get remove php5-suhosin

php composer.phar install
php app/console doctrine:migrations:migrate
php app/console doctrine:fixtures:load
php app/console assets:install
php app/console cache:clear --env=prod
