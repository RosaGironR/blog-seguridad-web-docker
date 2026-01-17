FROM php:8.2-apache

LABEL maintainer="rosaisabel"
LABEL description="Blog de Seguridad Web - Aplicación PHP con MySQL"
LABEL version="1.0"

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Solución robusta para MPM: Eliminar configuraciones conflictivas
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true && \
    rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* && \
    a2enmod mpm_prefork && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

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

# Comando de inicio
CMD ["apache2-foreground"]
