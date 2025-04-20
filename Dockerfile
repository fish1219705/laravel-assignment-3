# 使用 PHP 8.2 作為基底映像
FROM php:8.2-fpm

# 安裝 Nginx 和必要的擴展
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git

# 安裝 PHP 擴展
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 複製 Laravel 專案
WORKDIR /var/www
COPY . .

# 安裝 Laravel 依賴
RUN composer install

# 設置 Nginx 配置
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# 開放 HTTP 端口
EXPOSE 80

# 啟動 Nginx 和 PHP-FPM 伺服器
CMD service nginx start && php-fpm
