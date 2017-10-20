FROM php:7.1

COPY / /var/www/

WORKDIR /var/www/

RUN apt-get update

RUN apt-get install -y aptitude && apt-get install -y software-properties-common \
    && apt-get  -y install unzip zip git wget \
    && wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet \
    && php composer.phar install \
    && chmod a+x start.sh

CMD /var/www/start.sh