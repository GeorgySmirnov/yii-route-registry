FROM yiisoftware/yii2-php:7.1-apache

WORKDIR /app

COPY --chown=www-data:www-data . /app

RUN composer install -n
