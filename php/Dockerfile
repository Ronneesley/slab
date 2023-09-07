FROM composer:latest as bcomposer

COPY src/ /var/www/html/
WORKDIR /var/www/html/
RUN composer install

FROM node:latest as bnode

COPY src/ /var/www/html/
WORKDIR /var/www/html/
RUN npm install

FROM php:8.1-apache

COPY src/ /var/www/html/
COPY --from=bcomposer /var/www/html/vendor /var/www/html/vendor
COPY --from=bnode /var/www/html/node_modules /var/www/html/node_modules

