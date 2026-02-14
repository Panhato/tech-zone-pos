FROM php:8.2-apache

# 1. ដំឡើង Extension (MongoDB, Postgres)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions mongodb pdo_pgsql zip

# 2. កំណត់ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# 3. យក Composer មកប្រើ
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 4. ដំឡើង Library
RUN export COMPOSER_MEMORY_LIMIT=-1 && composer install --no-dev --optimize-autoloader --no-scripts --no-progress --prefer-dist

# 5. លុប Cache ចាស់ដែលជាប់ពីកុំព្យូទ័រ (សំខាន់បំផុត!)
RUN rm -f bootstrap/cache/*.php

# 6. ផ្តល់សិទ្ធិ
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# 7. បញ្ជាឱ្យបង្កើត Config ថ្មី និង Run Migration
CMD bash -c "php artisan config:cache && php artisan migrate --force && apache2-foreground"
