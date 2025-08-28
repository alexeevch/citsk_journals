# Makefile для Laravel Journals Backend
.PHONY: help build up down restart logs shell shell-db shell-redis key-generate jwt-secret migrate seed test clean

# Цвета для вывода
GREEN=\033[0;32m
YELLOW=\033[1;33m
RED=\033[0;31m
NC=\033[0m # No Color

# Помощь
help: ## Показать это сообщение помощи
	@echo "$(GREEN)Доступные команды для Laravel Backend:$(NC)"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  $(YELLOW)%-15s$(NC) %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Docker команды
build: ## Собрать Docker образы
	@echo "$(GREEN)Сборка Docker образов...$(NC)"
	docker-compose build --no-cache

up: ## Запустить все сервисы
	@echo "$(GREEN)Запуск сервисов...$(NC)"
	docker-compose up -d

down: ## Остановить все сервисы
	@echo "$(GREEN)Остановка сервисов...$(NC)"
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

# Вход в контейнеры
shell: ## Войти в контейнер приложения
	@echo "$(GREEN)Вход в контейнер приложения...$(NC)"
	docker-compose exec journals-backend bash

shell-db: ## Войти в контейнер базы данных
	@echo "$(GREEN)Вход в контейнер PostgreSQL...$(NC)"
	docker-compose exec postgres psql -U journals_user -d journals_db

shell-redis: ## Войти в контейнер Redis
	@echo "$(GREEN)Вход в контейнер Redis...$(NC)"
	docker-compose exec redis redis-cli

# Laravel команды
key-generate: ## Сгенерировать новый APP_KEY
	@echo "$(GREEN)Генерация нового APP_KEY...$(NC)"
	docker-compose exec journals-backend php artisan key:generate

jwt-secret: ## Сгенерировать JWT секрет
	@echo "$(GREEN)Генерация JWT секрета...$(NC)"
	docker-compose exec journals-backend php artisan jwt:secret

migrate: ## Выполнить миграции
	@echo "$(GREEN)Выполнение миграций...$(NC)"
	docker-compose exec journals-backend php artisan migrate

migrate-fresh: ## Пересоздать базу данных с миграциями
	@echo "$(YELLOW)Пересоздание базы данных...$(NC)"
	docker-compose exec journals-backend php artisan migrate:fresh

seed: ## Заполнить базу тестовыми данными
	@echo "$(GREEN)Заполнение базы тестовыми данными...$(NC)"
	docker-compose exec journals-backend php artisan db:seed

migrate-seed: migrate seed ## Выполнить миграции и заполнить данными

fresh-seed: migrate-fresh seed ## Пересоздать БД и заполнить данными

# Кэш команды
cache-clear: ## Очистить весь кэш
	@echo "$(GREEN)Очистка кэша...$(NC)"
	docker-compose exec journals-backend php artisan cache:clear
	docker-compose exec journals-backend php artisan config:clear
	docker-compose exec journals-backend php artisan route:clear
	docker-compose exec journals-backend php artisan view:clear

cache-config: ## Кэшировать конфигурацию
	@echo "$(GREEN)Кэширование конфигурации...$(NC)"
	docker-compose exec journals-backend php artisan config:cache

cache-routes: ## Кэшировать маршруты
	@echo "$(GREEN)Кэширование маршрутов...$(NC)"
	docker-compose exec journals-backend php artisan route:cache

# Composer команды
composer-install: ## Установить зависимости Composer
	@echo "$(GREEN)Установка зависимостей Composer...$(NC)"
	docker-compose exec journals-backend composer install

composer-update: ## Обновить зависимости Composer
	@echo "$(GREEN)Обновление зависимостей Composer...$(NC)"
	docker-compose exec journals-backend composer update

composer-dump: ## Обновить автозагрузку Composer
	@echo "$(GREEN)Обновление автозагрузки Composer...$(NC)"
	docker-compose exec journals-backend composer dump-autoload

# Тестирование
test: ## Запустить тесты
	@echo "$(GREEN)Запуск тестов...$(NC)"
	docker-compose exec journals-backend php artisan test

test-coverage: ## Запустить тесты с покрытием кода
	@echo "$(GREEN)Запуск тестов с покрытием кода...$(NC)"
	docker-compose exec journals-backend php artisan test --coverage

# Очистка
clean: ## Очистить все данные и контейнеры
	@echo "$(RED)Остановка и удаление всех контейнеров и данных...$(NC)"
	docker-compose down -v
	docker system prune -f
	docker volume prune -f

# Статус
status: ## Показать статус сервисов
	@echo "$(GREEN)Статус сервисов:$(NC)"
	docker-compose ps

# Первоначальная настройка
setup: build up key-generate jwt-secret migrate-seed ## Полная первоначальная настройка проекта
	@echo "$(GREEN)Backend успешно настроен!$(NC)"
	@echo "$(YELLOW)Laravel API доступно по адресу: http://localhost:8080$(NC)"

# Быстрый старт для разработки
dev: up logs-app ## Запустить в режиме разработки с логами 