init: docker-down docker-pull docker-build docker-up api-composer-install
down: docker-down

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

api-composer-install:
	docker-compose run --rm api-php-fpm composer install
