start:
	php -S localhost:3000 src/public/index.php

setup:
	composer install


compose-build:
	docker-compose build

compose-start:
	docker-compose up -d

compose-stop:
	docker-compose down -v

compose-setup: compose-build
	docker-compose run php-fpm make setup
