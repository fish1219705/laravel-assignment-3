FROM php:8.2-fpm

# 安裝 Nginx、Supervisord 與必要工具
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git

# 安裝 PHP 擴展
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo pdo_mysql

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 設定工作目錄
WORKDIR /var/www
COPY . .

# 安裝 Laravel 套件
RUN composer install --no-dev --optimize-autoloader \
 && chmod -R 775 storage bootstrap/cache

# 複製 Nginx 與 Supervisor 設定
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

# 使用 Supervisor 同時跑 Nginx 和 PHP-FPM
CMD ["/usr/bin/supervisord"]
