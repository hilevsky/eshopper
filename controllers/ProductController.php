<?php
/**
 * Created 16.02.2018 23:50 by E. Hilevsky
 */

/**
 * Контроллер для товара
 */

class ProductController
{
    /**
     *  Action для страницы просмотра товара
     * @param $id   id товара
     * @return bool
     */
    public function actionView($id){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Получаем информацию о товаре из БД
        $product = [];
        $product = Product::getProductById($id);

        // Подключаем вид
        require_once (ROOT.'/views/product/view.php');
        return true;
    }
}