# ใช้ PHP 8.2 FPM
FROM php:8.2-fpm

# ติดตั้งระบบและ library ที่จำเป็น
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip

# ติดตั้ง Node (สำหรับ build assets ถ้าต้องการ)
RUN apt-get install -y curl gnupg build-essential
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# ตั้ง working dir
WORKDIR /var/www

# คัดลอก composer files ก่อน (เพื่อ cache layer)
COPY composer.json composer.lock ./ 

# ติดตั้ง composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ติดตั้ง PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# คัดลอกไฟล์โปรเจกทั้งหมด
COPY . .

# ติดตั้ง npm และ build assets (Tailwind)
RUN if [ -f package.json ]; then npm install && npm run build; fi

# ให้ container ฟังที่พอร์ต 8080
EXPOSE 8080

# สร้าง APP_KEY ถ้ายังไม่มี (build time)
RUN php artisan key:generate --force || true

# รัน Laravel dev server (Railway จะ map port ให้)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
