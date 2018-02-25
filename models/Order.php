<?php
/**
 * Created 22.02.2018 0:23 by E. Hilevsky
 */

class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $products){

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products)
                VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        /*
        echo '<pre>';
        var_dump($products);
        echo '</pre>';
        */

        $products = json_encode($products);

        /*
        echo '<pre>';
        var_dump($products);
        echo '</pre>';
        */

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Возвращает список заказов
     * @return array    -- список заказов
     */
    public static function getOrderList(){
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order
                                        ORDER BY id DESC');

        $orderList=[];
        $i = 0;
        while($row = $result->fetch()){
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }
        return $orderList;
    }

    public static function getStatusText($status){
        switch($status){
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;

        }
    }

    /**
     * Удалить товар с указанным id
     * @param integer $id   -- id товара
     * @return bool
     */
    public static function deleteOrderById($id){
        $db = Db::getConnection();

        $sql = 'DELETE FROM product_order WHERE id=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOrderById($id){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        return $result->fetch();
    }

    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status){
        $db = Db::getConnection();

        $sql = 'UPDATE product_order SET 
                user_name=:user_name,
                user_phone=:user_phone,
                user_comment=:user_comment,
                date=:date,
                status=:status
                WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        return $result->execute();
    }
}