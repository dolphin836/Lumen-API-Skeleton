# Base Image
FROM php:8.1.16-cli-alpine
# Install Extensions
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories \
    && apk update \
    && apk add --no-cache ${PHPIZE_DEPS} \
    && pecl install redis-5.3.7 \
    && docker-php-ext-install pdo_mysql opcache sockets \
    && docker-php-ext-enable redis \
    && apk del ${PHPIZE_DEPS} \
    && apk add supervisor \
    && apk add tzdata
# Set Timezone
ENV TZ Asia/Shanghai
# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]