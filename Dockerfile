# 基本的 PHP 8.0 FPM 映像
FROM php:8.0-fpm

# 安裝 Laravel 需要的 PHP 擴展
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 設定工作目錄
WORKDIR /var/www

# 複製專案到 Docker 容器內
COPY . .

# 安裝 Laravel 依賴
RUN composer install

# 開放伺服器的端口
EXPOSE 9000

# 啟動 PHP FPM 服務
CMD ["php-fpm"]
