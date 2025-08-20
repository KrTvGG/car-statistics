FROM alpine:3.22

RUN apk add --no-cache \
    php-openssl \
    php-common \
    php-json \
    php-bcmath \
    php-gd \
    php-redis \
    php-xmlwriter \
    php-session \
    php-xml \
    php-ctype \
    php-curl \
    php-dom \
    php-fileinfo \
    php-mbstring \
    php-openssl \
    php-pdo \
    php-pdo_pgsql \
    php-pdo_mysql \
    php-simplexml \
    php-tokenizer \
    php-pgsql \
    imagemagick \
    imagemagick-libs \
    imagemagick-dev \
    php-pcntl \
    php-zip \
    composer

RUN adduser --shell /bin/sh --disabled-password -H --home /home/laravel laravel && \
    mkdir -p /app && \
    mkdir -p /home/laravel && \
    chown -R laravel:laravel /app && \
    chown -R laravel:laravel /home/laravel

WORKDIR /app

COPY ./entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
