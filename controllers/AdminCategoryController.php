<?php
/**
 * Created 23.02.2018 22:39 by E. Hilevsky
 */

/**
 * Class AdminCategoryController
 * Управление категориями товаров в админпанели
 */
class AdminCategoryController extends AdminBase
{
    /**
     * Action для страницы управления категориями
     */
    public function actionIndex(){
        self:self::checkAdmin();

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();

        //Подключаем вид
        require_once (ROOT.'/views/admin_category/index.php');
        return true;
    }

}