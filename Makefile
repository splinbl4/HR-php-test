init: docker-down-clear \
	 docker-build docker-up \
	 app-init
up: docker-up
down: docker-down
restart: down up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-build:
	docker-compose build

app-init: app-composer-install app-wait-db app-migrations app-db-seed

app-composer-install:
	docker-compose run --rm php-cli composer install

app-wait-db:
	sleep 10

app-key-generate:
	docker-compose run --rm php-cli php artisan key:generate

app-migrations:
	docker-compose run --rm php-cli php artisan migrate

app-db-seed:
	docker-compose run --rm php-cli php artisan db:seed

queue:
	docker-compose run --rm php-cli php artisan queue:work
