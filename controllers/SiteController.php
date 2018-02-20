<?php
/**
 * Created 16.02.2018 18:40 by E. Hilevsky
 */



class SiteController{

    public function actionIndex(){

        $categories =[];
        $categories = Category::getCategoriesList();

        $latestProduct = [];
        $latestProduct = Product::getLatestProducts(6);

        require_once(ROOT.'/views/site/index.php');



        return true;

    }
}