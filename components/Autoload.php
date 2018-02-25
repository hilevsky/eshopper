<?php
/**
 * Created 20.02.2018 15:19 by E. Hilevsky
 */
/**
 * Автозагрузка классов, вместо include в каждом файле
 * @param $class
 */
function autoload($class){

    // Спикок папок для поиска классов
    $array_path = ['/models/', '/components/'];

    foreach ($array_path as $path){
        $path = ROOT.$path.$class.'.php';
        if(is_file($path)){
            include_once $path;
        }
    }
}