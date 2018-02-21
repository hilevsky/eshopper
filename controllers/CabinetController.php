<?php
/**
 * Created 21.02.2018 0:23 by E. Hilevsky
 */

class CabinetController
{
    public function actionIndex(){
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе
        $user = User::getUserById(($userId));

        require_once (ROOT.'/views/cabinet/index.php');

        return true;
    }

}