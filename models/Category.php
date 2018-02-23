<?php
/**
 * Created 17.02.2018 20:34 by E. Hilevsky
 */
/**
 * Класс Category - модель для работы с категориями товаров
 */


class Category
{
    /**
     * Возвращает массив категорий для списка на сайте
     * @return array Массив с категориями
     */
    public static function getCategoriesList(){

        // соединение с БД
        $db = Db::getConnection();

        $categoryList = [];

        // запрос к БД
        $result = $db->query('SELECT id, name FROM category ORDER BY sort_order ASC');

        // Получаем результат и отдаем его
        $i=0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }

    /**
     * Возвращает массив всех категорий для списка в админпанели
     * @return array
     */
    public static function getCategoriesListAdmin(){
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        $categoryList = [];
        $i = 0;
        while($row = $result->fetch()){
          $categoryList[$i]['id'] = $row['id'];
          $categoryList[$i]['name'] = $row['name'];
          $categoryList[$i]['sort_order'] = $row['sort_order'];
          $categoryList[$i]['status'] = $row['status'];
          $i++;
        }
        return $categoryList;
    }

    /**
     * Возвращает категорию с указанным id
     * @param $id   id категории
     * @return array    массив с данными категории
     */
    public static function getCategoryById($id){

        $id = (int)($id);

        // Соединение с БД
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM category WHERE id = ".$id);

        // Указываем, что результат запроса нужен в виде ассоциативного массива
        $result -> setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результата
        return $result->fetch();

    }

    /**
     * Создает новую категорию (админпанель)
     * @param string $name  название категории
     * @param integer $sortOrder    порядковый номер
     * @param integer $status   вкл/выкл отображение
     * @return bool|string
     */
    public static function createCategory($name, $sortOrder, $status){
        $db=Db::getConnection();

        $sql = 'INSERT INTO category (name, sort_order, status)
                VALUES (:name, :sort_order, :status)
                ';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        return $result->execute();


    }

    public static function updateCategoryById($id, $options){
        $db=Db::getConnection();

        $sql = 'UPDATE category SET 
                    name = :name,
                    sort_order = :sort_order,
                    status = :status
                  WHERE id = :id
                  ';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();

    }
}