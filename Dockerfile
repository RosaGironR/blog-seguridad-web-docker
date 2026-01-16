FROM php:8.2-apache

LABEL maintainer="tu-email@example.com"
LABEL description="Blog de Seguridad Web - Aplicación PHP con MySQL"
LABEL version="1.0"

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

CMD ["apache2-foreground"]
