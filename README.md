# HMVC FlexiCMS
HMVC Flexible site management system

# Installation
1. We clone the repository.
2. Extract the files to the root directory of the site.
3. Create a database and import into it dump flexicms.sql
4. In the files (/config/database.php) we specify the connection parameters.

```
git clone https://github.com/artemmelnik/flexicms.git name_project
```

Next...

```
composer update
```

OR
```
php composer.phar update
```

Import db

```
php run db:import
```

Start dev server

```
php run server:start
```

Example /config/database.php
```
<?php
return [
    'host'     => 'localhost',
    'db_name'  => 'cms',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8'
];
```

Insert admin

Email: admin@admin.com
Password: 1111

```
INSERT INTO user
(email, password, role, hash)
VALUES ('admin@admin.com', 'b59c67bf196a4758191e42f76670ceba', 'admin', 'new')
```