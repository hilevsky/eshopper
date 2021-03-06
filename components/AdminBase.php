<?php
/**
 * Created 22.02.2018 20:16 by E. Hilevsky
 */

/**
 * абстрактный класс AdminBase содержит общую логику для контроллеров,
 * которые используются в панели администратора
 */
class AdminBase
{
    /**
     * Проверка, является ли пользоватеь администратором
     * для доступа к админпанели
     * @return bool
     */
    public static function checkAdmin(){

        // Проверяем, авторизован ли пользователь. Если нет, то переадресация на страницу login
        $userId = User::checkLogged();

        // Получаем id пользователя
        $user = User::getUserById($userId);

        // Если роль admin, разрешаем доступ в админпанель
        if($user['role'] == 'admin'){
            return true;
        }

        // Иначе завершаем работу с выводом сообщения
        die('У вас нет прав для доступа к этому разделу');
    }

}