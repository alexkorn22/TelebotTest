<?php
define('WWW', __DIR__);
define('ROOT', __DIR__);
define('APP', __DIR__ . '/app');
define('LIBS', __DIR__ . '/libs');

error_reporting(-1);

spl_autoload_register(function ($class) {
    $nameClass = str_replace('\\','/',$class);
    
    $file = WWW . "/$nameClass.php";
    if (file_exists($file)) {
        require_once $file;
    }
});
use core\App;
App::Init();