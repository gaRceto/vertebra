FROM php:8.2-apache

# Extensiones PHP necesarias
# GD: para generación de imágenes CAPTCHA con TTF
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    msmtp \
    && rm -rf /var/lib/apt/lists/*

# Configurar PHP para usar msmtp como sendmail
RUN echo 'sendmail_path = "/usr/bin/msmtp -t"' > /usr/local/etc/php/conf.d/mail.ini

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli

# Habilitar mod_rewrite, mod_expires, mod_headers
RUN a2enmod rewrite expires headers

# AllowOverride All para que .htaccess funcione
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

# X-Forwarded-Proto → HTTPS=on (necesario detrás de Traefik/proxy)
RUN printf '<IfModule mod_setenvif.c>\n    SetEnvIf X-Forwarded-Proto https HTTPS=on\n</IfModule>\n' \
    > /etc/apache2/conf-enabled/forwarded-proto.conf

COPY . /var/www/html/

# Reemplazar host=localhost por host=db y añadir charset=utf8mb4 en conexiones PDO
RUN find /var/www/html -name "*.php" \
    -exec sed -i 's/mysql:host=localhost; dbname=\([^'\'']*\)/mysql:host=db;dbname=\1;charset=utf8mb4/g' {} \; && \
    find /var/www/html -name "*.php" \
    -exec sed -i 's/mysql:host=localhost;dbname=\([^'\'']*\)/mysql:host=db;dbname=\1;charset=utf8mb4/g' {} \;

# Eliminar el redirect de dominio del .htaccess (en Docker lo gestiona Traefik)
# Mantiene el resto de reglas (caché, compresión, etc.)
RUN sed -i '/RewriteCond %{HTTP_HOST} !.*vertebraragon/d' /var/www/html/.htaccess && \
    sed -i '/RewriteRule.*vertebraragon\.com/d' /var/www/html/.htaccess

RUN chown -R www-data:www-data /var/www/html

COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

EXPOSE 80
CMD ["/docker-entrypoint.sh"]
