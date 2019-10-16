FROM richarvey/nginx-php-fpm:latest

ARG APP_ENV=prod
ARG APPLICATION_ENV=production
ENV WEBROOT=/var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV SKIP_COMPOSER=1
ENV RUN_SCRIPTS=1
ENV PHP_CATCHALL=1
ENV PHP_ERRORS_STDERR=1
ENV PHP_MEM_LIMIT=256mb
ENV PHP_UPLOAD_MAX_FILESIZE=16mb
ENV PHP_POST_MAX_SIZE=32mb
ENV REAL_IP_HEADER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
ENV LANG en_US.utf8

RUN /usr/local/bin/docker-php-ext-install pdo pdo_mysql mysqli

RUN set -eux; \
	composer global require "symfony/flex" --prefer-dist --no-progress --no-suggest --classmap-authoritative; \
	composer clear-cache

COPY api/composer.json api/composer.lock api/symfony.lock ./
RUN set -eux; \
	composer install --prefer-dist --no-dev --no-scripts --no-progress --no-suggest; \
	composer clear-cache

COPY api/.env ./
RUN composer dump-env prod; \
	rm .env

RUN mkdir scripts ; \
	wget -q https://raw.githubusercontent.com/GameTactic/Deployment/master/20-migrations.sh ; \
	chmod +x 20-migrations.sh ; \
	mv 20-migrations.sh scripts/

COPY api/bin bin/
COPY api/config config/
COPY api/public public/
COPY api/src src/
#COPY api/templates templates/

EXPOSE 80/tcp
