<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

define('ENV', 'Cms');

if (!is_file($_SERVER['DOCUMENT_ROOT'] . '/Cms/Config/database.php')) {
    header('Location: /install');
    exit;
}

require_once 'engine/bootstrap.php';
