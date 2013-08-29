#!/usr/bin/env bash

git pull

php app/console assets:install
php app/console cache:clear --env=prod
chmod -R 777 .
