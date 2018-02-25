<?php
/**
 * Created 21.02.2018 19:09 by E. Hilevsky
 */

/**
 * Class Cart - модель для работы с корзиной товаров
 */
class Cart
{
    /**
     * Добавление товара в корзину
     * @param integer $id   -- id товара
     */
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
        // Помещаем товары в сессионную переменную
        $_SESSION['products'] = $productsInCart;
    }

    /**
     * Счетчик для отображения кол-ва товаров в корзине
     * @return int  -- кол-во товаров
     */
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

    /**
     * Получение массива с товарами из корзины
     * @return type    -- массив с товарами, индекс - id товара, значение - кол-во товара
     *                      если корзина пуста - false
     */
    public static function getProducts(){
        if(isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Получение стоиомтси всех товаров в корзине
     * @param $products -- массив с товарами
     * @return int  -- стоимость
     */
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

    /**
     * Очищает корзину
     */
    public static function clear(){
        if(isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }

    /**
     * Удаляет товар из корзины
     * @param integer $id   -- id удаляемого товара
     */
    public static function deleteProduct($id){

        // Получаем корзину - массив с id и кол-вом товара
        $productsInCart = self::getProducts();

        // Удаляем из массива товар с указанным id
        unset($productsInCart[$id]);

        // Записываем массив товаров в сессию
        $_SESSION['products'] = $productsInCart;
    }

}