FROM php:8.1.7-fpm
RUN apt-get update && apt-get install -y git
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www

# Clone the repo
RUN git clone https://github.com/adriancespedes/ShoppingCart.git