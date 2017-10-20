#!/usr/bin/env bash

cd tests\

/var/www/vendor/bin/phpunit SorterTest
/var/www/vendor/bin/phpunit FlightClassTest

php ../index.php

bash