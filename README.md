# HMVC FlexiCMS

Гибкая CMS на базе HMVC и Twig.

## Что изменено (рефакторинг)

- Улучшены консольные команды:
  - `server:start` теперь поддерживает параметры `--host` и `--port`, выводит понятные сообщения и корректный код завершения.
  - `db:import` разбит на небольшие методы (подключение, поиск SQL-файлов, импорт файла), добавлена базовая обработка ошибок и более прозрачный вывод.

## Требования

- PHP 7.4+
- MySQL / MariaDB
- Composer

## Понятный план запуска (локально)

### 1) Клонировать проект

```bash
git clone https://github.com/artemmelnik/flexicms.git my-flexicms
cd my-flexicms
```

### 2) Установить зависимости

```bash
composer update
```

Если Composer не установлен глобально:

```bash
php composer.phar update
```

### 3) Настроить подключение к базе

Создайте/обновите файл `config/database.php`:

```php
<?php
return [
    'host'     => 'localhost',
    'db_name'  => 'cms',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8'
];
```

### 4) Импортировать структуру и данные БД

```bash
php run db:import
```

### 5) Запустить локальный сервер

Быстрый запуск:

```bash
php run server:start
```

С указанием хоста и порта:

```bash
php run server:start --host=127.0.0.1 --port=8080
```

После запуска откройте в браузере адрес, который выведет команда (например, `http://127.0.0.1:8000`).

## Доступ в админку

Если в вашей базе нет администратора, добавьте его вручную:

```sql
INSERT INTO user
(email, password, role, hash)
VALUES ('admin@admin.com', 'b59c67bf196a4758191e42f76670ceba', 'admin', 'new');
```

- Email: `admin@admin.com`
- Password: `1111`
