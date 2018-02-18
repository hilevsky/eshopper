<?php
/**
 * Created 17.02.2018 22:09 by E. Hilevsky
 */

/**
 * Class Product - модель для работы с товарами
 */
class Product
{
    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;

    /**
     * Возвращает массив последних товаров
     * @param int $count количество
     * @return array Массив с товарами
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT){

        $count = (int)($count);

        // Соединяемся с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id, `name`, price, image, is_new FROM product 
                WHERE status = 1 ORDER BY id DESC 
                LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде ассоциативного массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение запроса
        $result->execute();


        // Получение и возврат результатов
        $i = 0;
        $productsList =[];
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;

        }
         return $productsList;
    }

    /**
     * Получить список товаров указанной категории
     * @param bool $categoryId  id категории
     * @return array    массив с данными товаров
     */
    public static function getProductsListByCategory($categoryId = false){

        if($categoryId){

            // Соединяемся с БД
            $db = Db::getConnection();
            $products = [];

            // Запрос к БД
            $result = $db->query("SELECT id, name, price, image, is_new FROM product
                                  WHERE status = 1 AND category_id = '$categoryId' 
                                  ORDER BY id DESC LIMIT ".self::SHOW_BY_DEFAULT);

            // Получение и возврат результатов
            $i=0;
            $products =[];
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;

            }
            return $products;
        }
    }

    /**
     * Возвращает товар с указанным id
     * @param $id   id товара
     * @return array    массив с данными товара
     */
    public static function getProductById($id){

        $id = (int)($id);

        // Соединение с БД
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM product WHERE id = ".$id);

        // Указываем, что результат запроса нужен в виде ассоциативного массива
        $result -> setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результата
        return $result->fetch();

    }
}