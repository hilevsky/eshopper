<?php
/**
 * Created 21.02.2018 19:09 by E. Hilevsky
 */

class Cart
{
    public static function addProduct($id){

        $id = (int)$id;

        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары (храним их в сессии)
        if(isset($_SESSION['products'])){
            // то заполняем массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар уже в корзине, но был добавлен еще раз, увеличиваем его кол-во
        if(array_key_exists($id, $productsInCart)){
            $productsInCart[$id]++;
        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

    }

    public static function countItems(){
        if(isset($_SESSION['products'])){
            $count = 0;
            foreach($_SESSION['products'] as $id=>$quantity){
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts(){
        if(isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products){
        $productsInCart = self::getProducts();

        if($productsInCart){
            $total = 0;
            foreach ($products as $item){
                $total += $item['price']*$productsInCart[$item['id']];
            }
        }
        return $total;
    }

}