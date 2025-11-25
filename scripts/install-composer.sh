#!/bin/sh
# Download and install composer, then run composer install
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/tmp --filename=composer.phar
php /tmp/composer.phar install --no-dev --optimize-autoloader --no-interaction
rm -f composer-setup.php /tmp/composer.phar
