#!/bin/bash

./vendor/bin/sail up -d

sleep 5

docker-compose exec laravel.test bash -c "./cron.sh"

docker-compose exec laravel.test bash -c "crontab /var/www/html/cronfile"

docker-compose exec laravel.test bash -c "npm run dev"

exit
