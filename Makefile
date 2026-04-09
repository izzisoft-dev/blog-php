.PHONY: up down build restart logs shell composer seed

up:
	docker compose up -d

down:
	docker compose down

build:
	docker compose up -d --build

restart:
	docker compose restart

logs:
	docker compose logs -f

# Зайти в PHP-контейнер
shell:
	docker compose exec app sh

# Установить зависимости через Composer
composer:
	docker compose exec app composer install

# Запустить сидер
seed:
	docker compose exec app php database/seeder.php

# Компиляция SCSS один раз
scss-build:
	docker compose exec node npm run build

# Статус контейнеров
ps:
	docker compose ps
