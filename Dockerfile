FROM php:8.2.6-apache
RUN apt update -y
RUN a2enmod rewrite 
RUN a2enmod headers 
RUN a2enmod http2 
RUN apt update -y
RUN apt upgrade -y
RUN apt install curl -y
RUN apt install libcurl4-openssl-dev -y
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install curl