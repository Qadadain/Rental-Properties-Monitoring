#!/usr/bin/env sh

while ! mysqladmin ping -hdb --silent; do
    sleep 1
done

php /var/www/html/bin/console doctrine:migrations:migrate -n
php /var/www/html/bin/console doctrine:fixtures:load -n

exec "$@"
