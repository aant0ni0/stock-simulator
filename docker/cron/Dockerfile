FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    cron \
    libpq-dev \
    dos2unix \
    && docker-php-ext-install pdo_pgsql

COPY crontab /etc/cron.d/price-cron

RUN dos2unix /etc/cron.d/price-cron \
    && sed -i -e '$a\' /etc/cron.d/price-cron \
    && chmod 0644 /etc/cron.d/price-cron

RUN crontab /etc/cron.d/price-cron

WORKDIR /var/www

CMD ["cron", "-f"]
