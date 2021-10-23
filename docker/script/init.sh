#!/usr/bin/env sh
sleep 20

php /var/www/html/bin/console doctrine:database:create
php /var/www/html/bin/console doctrine:migrations:migrate -n
php /var/www/html/bin/console doctrine:fixtures:load -n

exec "$@"
