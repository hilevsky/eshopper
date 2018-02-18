<?php
/**
 * Created 16.02.2018 19:18 by E. Hilevsky
 */

/** FRONT CONTROLLER */

// 1. Общие настройки
    // Включаем отображение ошибок, на хостинге - отключить
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

// 2. Подключение файлов системы
    define('ROOT', dirname(__FILE__));
    require_once (ROOT.'/components/Router.php');

// 3. Подключение БД
include_once ROOT.'/components/Db.php';

// 3. Вызов Router
    $router = new Router();
    $router->run();