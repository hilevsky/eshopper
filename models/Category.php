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
}