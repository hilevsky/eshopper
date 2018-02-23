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
    public static function getProductsListByCategory($categoryId = false, $page = 1){

        if($categoryId){

            $page = (int)$page;
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            // Соединяемся с БД
            $db = Db::getConnection();
            $products = [];

            // Запрос к БД
            $result = $db->query("SELECT id, name, price, image, is_new FROM product
                                  WHERE status = 1 AND category_id = '$categoryId' 
                                  ORDER BY id DESC LIMIT ".self::SHOW_BY_DEFAULT." OFFSET ".$offset);

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

    /**
     *  Возвращает кол-во товаров в категории с заданным Id (пагинация)
     * $param int $categoryId   Id категории
     * @return int  кол-во товаров
     */
    public static function getTotalProductsInCategory($categoryId){

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product
                                        WHERE status=1 AND category_id='.$categoryId);
        $result -> setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];

    }

    /**
     * Возвращает кол-во всех товаров в БД (пагинация)
     * @return mixed
     */
    public static function getTotalProducts(){

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product
                                        WHERE status=1');
        $result -> setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];

    }

    public static function getProductsByIds($idsArray){

        $products = [];

        $db = Db::getConnection();

        $idsString = implode(', ', $idsArray);

        $sql = "SELECT * FROM product WHERE status=1 AND id IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i=0;
        while($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    /**
     * Возвращает массив рекомендованных товаров (для слайдера)
     * @return array
     */
    public static function getRecommendedProducts(){

        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, is_new FROM product
                WHERE status=1 AND is_recommended=1 ORDER BY id DESC';

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i=0;
        $productList = [];
        while($row = $result->fetch()){
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productList;
    }

    /**
     * Возвращает список всех товаров в БД
     * @return array массив с товарами
     */
    public static function getProductsList(){

        $productsList = [];

        $db = Db::getConnection();

        $sql = "SELECT id, name, price, code FROM product ORDER BY id ASC";

        $result = $db->query($sql);
        /*$result->setFetchMode(PDO::FETCH_ASSOC);*/

        $i=0;
        while($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /** Удаляем товар с указанным id
     * @param integer $id товара
     * @return bool
     */
    public static function deleteProductById($id){
        $db = Db::getConnection();

        $sql = 'DELETE FROM product WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    public static function createProduct($options){
        $db=Db::getConnection();

        $sql = 'INSERT INTO product (name, code, price, category_id, brand,
                availability, description, is_new, is_recommended, status)
                VALUES (:name, :code, :price, :category_id, :brand,
                :availability, :description, :is_new, :is_recommended, :status)
                ';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if($result->execute()){
            return $db->lastInsertId();
        }
        return false;
    }





    public static function updateProductById($id, $options){
        $db=Db::getConnection();

        $sql = 'UPDATE product SET 
                    name = :name,
                    code = :code,
                    price = :price,
                    category_id = :category_id,
                    brand = :brand,
                    availability = :availability,
                    description = :description,
                    is_new = :is_new,
                    is_recommended = :is_recommended,
                    status = :status
                  WHERE id = :id
                  ';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();

    }
}