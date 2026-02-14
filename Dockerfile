FROM php:8.2-apache

# ដំឡើងកម្មវិធីចាំបាច់
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# កំណត់ឱ្យ Apache ស្គាល់ folder public របស់ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# បើកមុខងារ Rewrite
RUN a2enmod rewrite

# ដំឡើង Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# ដំឡើង Library ទាំងអស់
RUN composer install --no-dev --optimize-autoloader

# ផ្តល់សិទ្ធិឱ្យ Folder storage (សំខាន់ណាស់)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
