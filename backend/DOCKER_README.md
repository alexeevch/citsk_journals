# Docker окружение для Laravel Backend

Это руководство поможет вам настроить локальное окружение для разработки Laravel API с использованием Docker.

## Архитектура

- **journals-backend**: Laravel 10 приложение с PHP 8.4, Nginx, PHP-FPM
- **postgres**: PostgreSQL 16 база данных
- **redis**: Redis 7 для кэша и очередей

## Быстрый старт

### 1. Подготовка файлов конфигурации

```bash
# Перейдите в папку backend
cd backend

# Скопируйте пример конфигурации Docker Compose
cp docker-compose.override.example.yml docker-compose.override.yml
```

### 2. Первоначальная настройка

```bash
# Полная настройка проекта (сборка, запуск, генерация ключей, миграции)
make setup
```

### 3. Проверка работы

Откройте браузер и перейдите по адресу: http://localhost:8080

## Основные команды

### Управление Docker

```bash
make help          # Показать все доступные команды
make build         # Собрать Docker образы
make up            # Запустить все сервисы
make down          # Остановить все сервисы
make restart       # Перезапустить все сервисы
make status        # Показать статус сервисов
```

### Логи

```bash
make logs          # Логи всех сервисов
make logs-app      # Логи только приложения
make logs-db       # Логи PostgreSQL
make logs-redis    # Логи Redis
```

### Вход в контейнеры

```bash
make shell         # Войти в контейнер приложения
make shell-db      # Войти в PostgreSQL (psql)
make shell-redis   # Войти в Redis CLI
```

### Laravel команды

```bash
make key-generate  # Сгенерировать APP_KEY
make jwt-secret    # Сгенерировать JWT секрет
make migrate       # Выполнить миграции
make seed          # Заполнить тестовыми данными
make migrate-seed  # Миграции + заполнение данными
make fresh-seed    # Пересоздать БД + заполнение
```

### Кэш

```bash
make cache-clear   # Очистить весь кэш
make cache-config  # Кэшировать конфигурацию
make cache-routes  # Кэшировать маршруты
```

### Composer

```bash
make composer-install  # Установить зависимости
make composer-update   # Обновить зависимости
make composer-dump     # Обновить автозагрузку
```

### Тестирование

```bash
make test          # Запустить тесты
make test-coverage # Тесты с покрытием кода
```

## Разработка

### Режим реального времени

Благодаря volume mapping, все изменения в коде автоматически отражаются в контейнере без перезапуска.

### Xdebug

Xdebug настроен и готов к использованию. Убедитесь, что в `docker-compose.override.yml` установлено:

```yaml
environment:
  XDEBUG: "1"
```

### Доступ к сервисам

- **Laravel API**: http://localhost:8080
- **PostgreSQL**: localhost:5432
  - Database: `journals_db`
  - User: `journals_user`
  - Password: `journals_password`
- **Redis**: localhost:6379

## Структура файлов

```
backend/
├── docker-compose.yml                    # Основная конфигурация
├── docker-compose.override.example.yml  # Пример настроек для разработки
├── docker-compose.override.yml          # Ваши локальные настройки (не в git)
├── Makefile                             # Удобные команды
└── docker/
    ├── base.Dockerfile                  # Базовый образ
    ├── Dockerfile                       # Продакшн образ
    ├── entrypoint.sh                   # Скрипт запуска
    └── config/                         # Конфигурации
        ├── nginx.conf
        ├── supervisord.conf
        └── php/
            ├── fpm-pool.conf
            ├── php.ini
            └── xdebug.ini
```

## Переменные окружения

Основные переменные настроены в `docker-compose.override.yml`:

### Laravel
- `APP_NAME`: Название приложения
- `APP_ENV`: Окружение (local/production)
- `APP_KEY`: Ключ приложения (генерируется автоматически)
- `APP_DEBUG`: Режим отладки

### База данных
- `DB_CONNECTION`: pgsql
- `DB_HOST`: postgres
- `DB_DATABASE`: journals_db
- `DB_USERNAME`: journals_user
- `DB_PASSWORD`: journals_password

### Redis
- `REDIS_HOST`: redis
- `REDIS_PORT`: 6379
- `CACHE_DRIVER`: redis
- `SESSION_DRIVER`: redis
- `QUEUE_CONNECTION`: redis

## Устранение неполадок

### Контейнер не запускается

```bash
# Проверьте логи
make logs-app

# Пересоберите образ
make build
```

### Проблемы с правами доступа

```bash
# Войдите в контейнер и проверьте права
make shell
ls -la /var/www/html/storage
```

### Очистка всех данных

```bash
# ВНИМАНИЕ: Удалит все данные!
make clean
```

### База данных не доступна

```bash
# Проверьте статус PostgreSQL
make logs-db

# Войдите в базу данных
make shell-db
```

## Интеграция с Frontend

В монорепозитории frontend будет расположен в папке `../frontend`. Backend API будет доступно по адресу `http://localhost:8080` для frontend приложения.

### Настройка CORS

Убедитесь, что в `config/cors.php` разрешены запросы с frontend:

```php
'allowed_origins' => ['http://localhost:3000', 'http://localhost:5173'],
```

## Дополнительная настройка

### Изменение портов

Отредактируйте `docker-compose.override.yml`:

```yaml
services:
  journals-backend:
    ports:
      - "8081:8080"  # Изменить на нужный порт
```

### Настройка PHP

Отредактируйте `docker/config/php/php.ini` и пересоберите образ:

```bash
make build
make restart
``` 