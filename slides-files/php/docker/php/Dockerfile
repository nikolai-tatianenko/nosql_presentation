FROM php:7.3-apache


RUN apt-get update

# Install Redis.
RUN pecl install redis-5.0.2 \
    && docker-php-ext-enable redis

# Install Memcached.
RUN apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.1.3 \
    && docker-php-ext-enable memcached

RUN apt-get install php-memcached


# Install Xdebug.
#RUN  pecl install xdebug-2.6.0 \
#    && docker-php-ext-enable xdebug

# Install Mongo.
#RUN pecl install mongo-1.6.16 \
#    && docker-php-ext-enable mongo