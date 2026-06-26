# Car Ads REST API

REST API сервис для управления объявлениями автомобилей на PHP 8, Yii2 и PostgreSQL.

## Архитектура

Проект организован по многослойной архитектуре:

- **Entity** — доменные сущности (`Car`, `CarOption`)
- **DataMapper** — преобразование между БД и сущностями
- **Repository** — доступ к данным
- **Service** — бизнес-логика
- **Controller** — REST API endpoints

Зависимости управляются через Dependency Injection (Yii2 Container).

## Требования

- PHP 8.1+
- Composer
- PostgreSQL 14+ (или Docker)

## Быстрый старт (Docker)

```bash
git clone git@github.com:bratherem/it-link-test.git
cd it-link-test
cp .env.example .env
docker compose up --build
```

API будет доступен по адресу: http://localhost:8080

Миграции применяются автоматически при старте контейнера `app`.

## Локальная установка

```bash
git clone git@github.com:bratherem/it-link-test.git
cd it-link-test
cp .env.example .env
composer install
```

Настройте PostgreSQL и переменные окружения в `.env` (или используйте значения по умолчанию из `.env.example`).

Примените миграции:

```bash
php yii migrate/up
```

Запустите встроенный сервер:

```bash
php yii serve
```

По умолчанию сервер слушает http://localhost:8080

## API Endpoints

### POST /car/create

Создаёт новое объявление.

```bash
curl -X POST http://localhost:8080/car/create \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Toyota Camry",
    "description": "Отличное состояние",
    "price": 15000,
    "photo_url": "https://example.com/photo.jpg",
    "contacts": "+1234567890",
    "options": {
      "brand": "Toyota",
      "model": "Camry",
      "year": 2019,
      "body": "sedan",
      "mileage": 80000
    }
  }'
```

Ответ: `201 Created` с данными объявления.

Поле `options` необязательно. Если передано — все поля объекта обязательны.

### GET /car/{id}

Возвращает одно объявление по ID.

```bash
curl http://localhost:8080/car/1
```

### GET /car/list

Возвращает список объявлений с пагинацией.

```bash
curl "http://localhost:8080/car/list?page=1"
```

## Миграции

Создание новой миграции:

```bash
php yii migrate/create create_new_table
```

Применение миграций:

```bash
php yii migrate/up
```

## Тесты

```bash
composer install
vendor/bin/phpunit
```

Unit-тесты для `CarService::create` покрывают сценарии с опциями, без опций и валидацию.

CI запускается автоматически при push в GitHub (см. `.github/workflows/ci.yml`).

## Структура БД

**car**

| Поле        | Тип       |
|-------------|-----------|
| id          | serial PK |
| title       | varchar   |
| description | text      |
| price       | decimal   |
| photo_url   | varchar   |
| contacts    | varchar   |
| created_at  | timestamp |

**car_option**

| Поле    | Тип       |
|---------|-----------|
| id      | serial PK |
| car_id  | integer FK → car.id |
| brand   | varchar   |
| model   | varchar   |
| year    | integer   |
| body    | varchar   |
| mileage | integer   |

Связь: одно объявление может иметь одну запись технических характеристик (has-one).
