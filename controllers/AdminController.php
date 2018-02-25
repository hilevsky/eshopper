<?php
/**
 * Created 22.02.2018 20:14 by E. Hilevsky
 */

/**
 * Class AdminController
 * Для главной страницы в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для главной страницы админпанели
     * @return bool
     */
    public function actionIndex(){

        // Проверка прав доступа
        self::checkAdmin();

        // Подключаем вид
        require_once (ROOT.'/views/admin/index.php');
        return true;
    }

}