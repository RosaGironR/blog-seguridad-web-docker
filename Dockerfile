FROM php:8.2-fpm

LABEL maintainer="rosaisabel"
LABEL description="Blog de Seguridad Web - Aplicación PHP con MySQL"
LABEL version="1.0"

# Instalar Nginx y dependencias
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Configurar Nginx
RUN rm -f /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/sites-enabled/default

# Copiar script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Copiar código de la aplicación
COPY app/ /var/www/html/

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer puerto 80
EXPOSE 80

# Healthcheck
HEALTHCHECK --interval=30s --timeout=3s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Script de inicio para Nginx y PHP-FPM
CMD ["/start.sh"]
