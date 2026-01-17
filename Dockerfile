FROM php:8.2-apache-bookworm

LABEL maintainer="rosaisabel"
LABEL description="Blog de Seguridad Web - Aplicación PHP con MySQL"
LABEL version="1.0"

# Configurar Apache antes de instalar extensiones
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    rm -f /etc/apache2/conf-enabled/other-vhosts-access-log.conf

# Limpiar y configurar MPM correctamente mediante symlinks directos
RUN rm -rf /etc/apache2/mods-enabled/mpm_* && \
    ln -s /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf && \
    ln -s /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

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
