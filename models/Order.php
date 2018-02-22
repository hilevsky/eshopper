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
}