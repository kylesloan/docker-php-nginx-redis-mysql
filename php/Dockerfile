# https://github.com/matriphe/docker-alpine-php/blob/master/5.6/FPM/Dockerfile
# So start with this guys image and just add php-redis module in.
# Lets use php5.6 for now.
FROM matriphe/alpine-php:fpm-5.6

# so the image doesn't have php5-redis, so lets install it, its only on alpine edge
# https://hub.docker.com/r/wodby/nginx-php-5.6-alpine/~/dockerfile/
RUN echo '@testing http://nl.alpinelinux.org/alpine/edge/testing' >> /etc/apk/repositories && \
    apk add --update php5-redis@testing
