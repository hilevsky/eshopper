<?php
/**
 * Created 21.02.2018 19:07 by E. Hilevsky
 */

class CartController
{
    public function actionAdd($id){

        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользоваетля на исходную страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionIndex(){

        $categories =[];
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        // Получаем данные из корзины
        $productsInCart = Cart::getProducts();

        if($productsInCart){
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            // Получаем полную стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        require_once (ROOT.'/views/cart/index.php');

        return true;
    }

}