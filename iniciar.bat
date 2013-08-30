git stash save
git pull
php composer.phar selfupdate
php composer.phar install
php app/console doctrine:migrations:migrate
php app/console doctrine:fixtures:load
php app/console assets:install
php app/console cache:clear --env=prod
git stash apply