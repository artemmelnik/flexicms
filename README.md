# FlexiCMS
Flexible site management system

# Installation
1. We clone the repository.
2. Extract the files to the root directory of the site.
3. Create a database and import into it dump cms.sql
4. In the files (/cms/Config/database.php, /admin/Config/database.php) we specify the connection parameters.

Example /cms/Config/database.php
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
