## Разработчикам

Склонировать проект

### Разворачивание проекта

- Собрать контейнеры

    `docker-compose up --build`

(вход в контейнер `docker exec -it armoire-piha-1 bash`)

- Установить зависимости
    `composer install --optimize-autoloader`

(пример установки достаточных прав `chmod -R 777 /var/www/storage`)

- Создать файл .env в корне сайта на базе .env.example

- Сгенерировать ключ приложения

    `php artisan key:generate`

- Сконфигурировать кэш фреймворка

    `php artisan config:cache`

**Готово**
