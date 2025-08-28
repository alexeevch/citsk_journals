#!/bin/bash

if [[ -z $XDEBUG ]]; then
  echo "xdebug.mode=off" >> /etc/php/8.4/fpm/conf.d/99-custom-xdebug.ini
fi

php artisan migrate --force
php artisan config:cache
php artisan route:cache

php artisan storage:link

/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
