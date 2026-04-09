# Blog PHP

Простой блог на чистом PHP 8.1 без фреймворков, с шаблонизатором Smarty и MySQL.

## Стек

- PHP 8.1 + Nginx
- MySQL 8
- Smarty 5
- SCSS
- Docker

## Запуск

```bash
# 1. Клонировать репозиторий
git clone ...
cd blog-php

# 2. Создать .env
cp src/.env.example src/.env

# 3. Собрать и запустить контейнеры
make build

# 4. Установить зависимости
make composer

# 5. Заполнить БД тестовыми данными
make seed
```

## Доступные адреса

| Сервис      | URL                        |
|-------------|----------------------------|
| Сайт        | http://localhost:8080       |
| phpMyAdmin  | http://localhost:8081       |

## Команды

```bash
make build       # сборка и запуск контейнеров
make up          # запуск контейнеров
make down        # остановка контейнеров
make shell       # войти в PHP контейнер
make composer    # установить зависимости
make seed        # заполнить БД тестовыми данными
make logs        # логи контейнеров
```

## Структура проекта

```
src/
├── app/
│   ├── Controllers/     # контроллеры
│   ├── Core/            # Router, Controller, Model, View, Database
│   └── Models/          # модели (Post, Category)
├── config/              # конфигурация БД
├── database/            # сидер
├── public/              # точка входа, css, uploads
├── resources/
│   ├── scss/            # исходники стилей
│   └── views/           # Smarty шаблоны
└── routes/
    └── web.php          # маршруты
```

## Страницы

- `/` — главная, категории с 3 последними постами
- `/category/{slug}` — страница категории, сортировка и пагинация
- `/post/{slug}` — страница поста, похожие статьи
