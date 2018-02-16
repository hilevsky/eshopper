<?php
/**
 * Created 16.02.2018 19:23 by E. Hilevsky
 */

class Router
{
    private $routes;

    public function __construct(){

        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса (из адресной строки)
     * @return string
     */
    private function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){

        // Получить строку запроса
        $uri = $this->getUri();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){


            // Сравниваем строку запроса с заисями в routes.php
            if (preg_match("~$uriPattern~", $uri)){

                // Определить, какой контроллер и action обрабатывают запрос
                $segments = explode('/', $path);        // получаем массив, в котором первый элемент - контроллер
                                                                // второй - action
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                // Подключить файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }

                // Создать объект, вызвать метод (action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }

            }
        }
    }

}