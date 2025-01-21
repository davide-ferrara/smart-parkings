#!/bin/bash

for i in {1..6}; do
    php /var/www/html/artisan updateParkingStatusJob
    sleep 10
done


