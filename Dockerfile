FROM php:8.2-apache

# 1. ដំឡើង Extension
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions mongodb pdo_pgsql zip intl gd

# 2. កំណត់ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# 3. យក Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# --- ផ្នែកសំខាន់ (Smart Cache) ---
# 4. Copy តែឯកសារបញ្ជីឈ្មោះ Library ចូលមុន
COPY composer.json composer.lock ./

# 5. ដំឡើង Library (បើឯកសារខាងលើមិនប្តូរ វានឹងរំលងកន្លែងនេះ មិនស៊ី RAM ទេ)
RUN export COMPOSER_MEMORY_LIMIT=-1 \
    && composer install --no-dev --no-scripts --no-progress --prefer-dist --no-autoloader

# 6. ទើប Copy កូដរបស់បងចូលតាមក្រោយ
COPY . .

# 7. រៀបចំ Autoload (ស្រាលៗ)
RUN composer dump-autoload --optimize

# 8. លុប Cache និងផ្តល់សិទ្ធិ
RUN rm -f bootstrap/cache/*.php
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# 9. Start Server
CMD bash -c "php artisan optimize:clear && php artisan migrate --force && php artisan storage:link && apache2-foreground"
