FROM php:8.2-apache

# 1. ប្រើ Script ពិសេសដើម្បីដំឡើង Extension (មិនស៊ី RAM)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# 2. ដំឡើង MongoDB និង PostgreSQL
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions mongodb pdo_pgsql zip

# 3. កំណត់ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# 4. យក Composer មកប្រើ
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 5. ដំឡើង Library (ថែម Memory Limit កុំឱ្យគាំង)
RUN export COMPOSER_MEMORY_LIMIT=-1 && composer install --no-dev --optimize-autoloader --no-scripts --no-progress --prefer-dist

# 6. ផ្តល់សិទ្ធិ
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
