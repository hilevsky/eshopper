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

}