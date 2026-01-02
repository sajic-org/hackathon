FROM dunglas/frankenphp:1.11.1-php8.4.16-alpine

RUN apk add --no-cache nodejs npm

RUN install-php-extensions \
    @composer \
    pcntl \
    pdo_pgsql \
    pgsql \
    intl \
    zip \
    redis

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .

RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

ARG VITE_APP_NAME="Hackathon"
RUN npm run build

RUN php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache

# isso é a build de produção, então o CMD tá no docker compose :P
