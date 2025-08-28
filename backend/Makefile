# Makefile для Laravel Journals Backend
.PHONY: help build up down restart logs shell shell-db shell-redis migrate seed test clean

help: ## Показать это сообщение помощи
	@echo "Доступные команды для Laravel Backend:"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  %-15s %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Собрать Docker образы
	@echo "Сборка Docker образов..."
	docker-compose build --no-cache

up: ## Запустить все сервисы
	@echo "Запуск сервисов..."
	docker-compose up -d

down: ## Остановить все сервисы
	@echo "Остановка сервисов..."
	docker-compose down

restart: down up ## Перезапустить все сервисы

logs: ## Показать логи всех сервисов
	docker-compose logs -f

logs-app: ## Показать логи только приложения
	docker-compose logs -f journals-backend

logs-db: ## Показать логи базы данных
	docker-compose logs -f postgres

logs-redis: ## Показать логи Redis
	docker-compose logs -f redis

shell: ## Войти в контейнер приложения
	@echo "Вход в контейнер приложения..."
	docker-compose exec journals-backend bash

shell-db: ## Войти в контейнер базы данных
	@echo "Вход в контейнер PostgreSQL..."
	docker-compose exec postgres psql -U journals_user -d journals_db

shell-redis: ## Войти в контейнер Redis
	@echo "Вход в контейнер Redis..."
	docker-compose exec redis redis-cli

migrate: ## Выполнить миграции
	@echo "Выполнение миграций..."
	docker-compose exec journals-backend php artisan migrate

migrate-fresh: ## Пересоздать базу данных с миграциями
	@echo "Пересоздание базы данных..."
	docker-compose exec journals-backend php artisan migrate:fresh

seed: ## Заполнить базу тестовыми данными
	@echo "Заполнение базы тестовыми данными..."
	docker-compose exec journals-backend php artisan db:seed

migrate-seed: migrate seed ## Выполнить миграции и заполнить данными

fresh-seed: migrate-fresh seed ## Пересоздать БД и заполнить данными

cache-clear: ## Очистить весь кэш
	@echo "Очистка кэша..."
	docker-compose exec journals-backend php artisan cache:clear
	docker-compose exec journals-backend php artisan config:clear
	docker-compose exec journals-backend php artisan route:clear
	docker-compose exec journals-backend php artisan view:clear

cache-config: ## Кэшировать конфигурацию
	@echo "Кэширование конфигурации..."
	docker-compose exec journals-backend php artisan config:cache

cache-routes: ## Кэшировать маршруты
	@echo "Кэширование маршрутов..."
	docker-compose exec journals-backend php artisan route:cache

composer-install: ## Установить зависимости Composer
	@echo "Установка зависимостей Composer..."
	docker-compose exec journals-backend composer install

composer-update: ## Обновить зависимости Composer
	@echo "Обновление зависимостей Composer..."
	docker-compose exec journals-backend composer update

composer-dump: ## Обновить автозагрузку Composer
	@echo "Обновление автозагрузки Composer..."
	docker-compose exec journals-backend composer dump-autoload

test: ## Запустить тесты
	@echo "Запуск тестов..."
	docker-compose exec journals-backend php artisan test

test-coverage: ## Запустить тесты с покрытием кода
	@echo "Запуск тестов с покрытием кода..."
	docker-compose exec journals-backend php artisan test --coverage

clean: ## Очистить все данные и контейнеры
	@echo "Остановка и удаление всех контейнеров и данных..."
	docker-compose down -v
	docker system prune -f
	docker volume prune -f

status: ## Показать статус сервисов
	@echo "Статус сервисов:"
	docker-compose ps

setup: build up migrate-seed ## Полная первоначальная настройка проекта
	@echo "Backend успешно настроен!"

# Быстрый старт для разработки
dev: up logs-app ## Запустить в режиме разработки с логами
