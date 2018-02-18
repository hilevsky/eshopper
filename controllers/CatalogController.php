<?php
/**
 * Created 18.02.2018 1:00 by E. Hilevsky
 */

/**
 * Контроллер для каталога товаров
 */

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class CatalogController
{

    public function actionIndex(){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProduct = [];
        $latestProduct = Product::getLatestProducts(12);

        // Подключаем вид
        require_once(ROOT.'/views/catalog/index.php');

        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     * @param $categoryId   id категории
     * @return bool
     */
    public function actionCategory($categoryId){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Списко товаров в категории
        $categoryProduct = [];
        $categoryProduct = Product::getProductsListByCategory($categoryId);

        // Подключаем вид
        require_once (ROOT.'/views/catalog/category.php');

        return true;
    }
}
