#!/usr/bin/env sh

cp .env .env.local
echo 'DATABASE_URL="mysql://root:rootroot@db:3306/RPM?serverVersion=5.7"' >> /var/www/html/.env.local
composer install
yarn install
yarn encore dev
