<?php 


define('APROOT', "");
define('URLROOT', "todo");

define('DB_SERVER', "localhost");
define('DB_NAME', "mbdb");
define('DB_USER', "root");
define('DB_PASSWORD', "");


spl_autoload_register(function ($class) {
    include 'libraries/' . $class . '.php';
});