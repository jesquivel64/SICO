#!/usr/bin/env bash

git stash save
git pull

php app/console doctrine:migrations:migrate
php app/console assets:install
php app/console cache:clear --env=prod
chmod -R 777 .
