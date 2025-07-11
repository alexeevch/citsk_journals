# Переменные
COMPOSE=docker-compose
DC_DEV=$(COMPOSE) -f docker-compose.yml
DC_PROD=$(COMPOSE) -f docker-compose.prod.yml

.PHONY: all up down build sh artisan migrate test logs deploy

all: up

# Локальная разработка
up:
	@$(DC_DEV) up -d
	@echo "Контейнеры запущены. Запусти 'make artisan migrate'"

down:
	@$(DC_DEV) down

build:
	@$(DC_DEV) build --pull

rebuild:
	@$(DC_DEV) down -v --remove-orphans
	@$(DC_DEV) build --no-cache
	@$(DC_DEV) up -d --force-recreate

sh:
	@$(DC_DEV) exec app sh

artisan:
	@$(DC_DEV) exec app php artisan $(filter-out $@,$(MAKECMDGOALS))

# Примеры: make artisan migrate | make artisan tinker
migrate:
	@make artisan migrate --force

test:
	@$(DC_DEV) exec app vendor/bin/phpunit

logs:
	@$(DC_DEV) logs -f

# Деплой (пример GitHub Actions/CI хука)
deploy:
	@git push origin main
	@ssh user@prod 'cd /path/to/project && docker-compose -f docker-compose.prod.yml pull && docker-compose -f docker-compose.prod.yml up -d'
