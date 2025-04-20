# 使用 PHP 8.2 作為基底映像
FROM php:8.2-fpm

# 安裝需要的擴展
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 複製你的 Laravel 專案
WORKDIR /var/www
COPY . .

# 安裝 Laravel 依賴
RUN composer install

# 開放伺服器端口
EXPOSE 9000
CMD ["php-fpm"]

