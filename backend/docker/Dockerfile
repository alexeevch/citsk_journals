# Базовый образ
FROM journals-base as base

# Продакшн образ
FROM base as production

COPY docker/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY --chown=web:web . /var/www/html/

WORKDIR /var/www/html/

RUN composer install --optimize-autoloader --no-interaction --no-progress --no-dev

USER web

HEALTHCHECK --start-period=1m --timeout=10s --interval=1m CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
