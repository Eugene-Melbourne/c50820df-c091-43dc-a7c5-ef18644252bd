
## Installing Development Environment


For the current project I installed the Laravel Sail on Windows
The detailed instruction provided in here: https://laravel.com/docs/11.x/installation#sail-on-windows

I chose to work in Windows PowerShell instead of Windows Terminal.

I chose to install Ubuntu distribution of WSL

    $ wsl --install -d Ubuntu
    $ wsl --set-default Ubuntu
sign in into ubuntu wsl

    $ wsl
install laravel sail

    $ curl -s https://laravel.build/acer-test | bash
start the sail

    $ cd acer-test
    $ ./vendor/bin/sail up

Checks
  -  web application can be checked in a browser http://localhost or http://127.0.0.1
  -  and database can be accessed in the 127.0.0.1:3306

## Running commands


composer install

    $ ./vendor/bin/sail composer install
artisan migrate

    $ ./vendor/bin/sail artisan migrate

But it is better to go into Shell

    $ ./vendor/bin/sail shell

### From Shell we can run

phpstan analyse

    $ ./vendor/bin/phpstan analyse

phpunit

    $ vendor/bin/phpunit

### Running The Report

    php artisan report:generate

#
