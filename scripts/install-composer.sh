#!/bin/sh
# Download and install composer, then run composer install
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/tmp --filename=composer.phar
php /tmp/composer.phar install --optimize-autoloader --no-interaction
php /tmp/composer.phar dump-autoload -o
php artisan package:discover --ansi || true
rm -f composer-setup.php /tmp/composer.phar
