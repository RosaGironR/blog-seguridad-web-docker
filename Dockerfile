FROM php:8.2-apache

LABEL maintainer="tu-email@example.com"
LABEL description="Blog de Seguridad Web - Aplicación PHP con MySQL"
LABEL version="1.0"

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Deshabilitar MPMs que no se usan (SOLUCIÓN AL ERROR)
RUN a2dismod mpm_event mpm_worker
RUN a2enmod mpm_prefork

# Habilitar mod_rewrite para Aapche (si lo necesitas)
RUN a2enmod rewrite

# Copiar codigo de la aplicacion
COPY app/ /var/www/html/

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

    # Exponer puerto 80
EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

    # Comando de inicio
CMD ["apache2-foreground"]
