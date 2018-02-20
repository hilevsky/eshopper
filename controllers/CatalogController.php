<?php
/**
 * Created 18.02.2018 1:00 by E. Hilevsky
 */

/**
 * Контроллер для каталога товаров
 */


class CatalogController
{

    public function actionIndex($page = 1){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProduct = [];
        $latestProduct = Product::getLatestProducts(12);

        // Кол-во товаров в базе данных для Pagination
        $total = Product::getTotalProducts();

        // Создаем объекм Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT.'/views/catalog/index.php');

        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     * @param $categoryId   id категории
     * @return bool
     */
    public function actionCategory($categoryId, $page = 1){


        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Список товаров в категории
        $categoryProduct = [];
        $categoryProduct = Product::getProductsListByCategory($categoryId, $page);

        // Кол-во товаров в категории для Pagination
        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объекм Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once (ROOT.'/views/catalog/category.php');

        return true;
    }
}
