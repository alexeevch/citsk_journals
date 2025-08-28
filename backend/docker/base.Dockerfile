FROM ubuntu:24.04 as journals-base

WORKDIR /var/www/html

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get update

RUN apt-get update && apt-get install -y \
    php8.4 \
    php8.4-ctype \
    php8.4-curl \
    php8.4-dom \
    php8.4-fpm \
    php8.4-gd \
    php8.4-intl \
    php8.4-mbstring \
    php8.4-pgsql \
    php8.4-mysql \
    php8.4-sqlite \
    php8.4-opcache \
    php8.4-phar \
    php8.4-xml \
    php8.4-xmlreader \
    php8.4-xdebug \
    php8.4-imagick \
    php8.4-raphf \
    php8.4-http \
    php8.4-zip \
    php8.4-soap \
    php8.4-redis \
    supervisor \
    nginx \
    iputils-ping \
    unzip \
    wget \
    curl \
    redis-tools \
    vim \
    git

RUN wget https://getcomposer.org/download/latest-stable/composer.phar && \
    chmod +x ./composer.phar && \
    mv ./composer.phar /usr/bin/composer

#COPY docker/certs/openssl.cnf  /etc/ssl/openssl.cnf

RUN useradd -m web

COPY docker/config/nginx.conf /etc/nginx/nginx.conf

COPY docker/config/php/fpm-pool.conf /etc/php/8.4/fpm/pool.d/www.conf

COPY docker/config/php/php.ini /etc/php/8.4/fpm/conf.d/custom.ini
COPY --chmod=777 docker/config/php/xdebug.ini /etc/php/8.4/fpm/conf.d/99-custom-xdebug.ini

#COPY docker/certs/root_ca_pem.crt /usr/local/share/ca-certificates
#COPY docker/certs/sub_ca_pem.crt /usr/local/share/ca-certificates
#RUN update-ca-certificates

COPY docker/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh

RUN chown -R web:web /var/www/html /run /var/lib/nginx /var/log/nginx
RUN chown -R web:web /entrypoint.sh && chmod u+x /entrypoint.sh

USER web

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
