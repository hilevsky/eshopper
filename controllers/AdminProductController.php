<?php
/**
 * Created 22.02.2018 21:01 by E. Hilevsky
 */

/**
 * Class AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase
{
    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex(){

        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $productsList = Product::getProductsList();

        // Подключаем вид
        require_once (ROOT.'/views/admin_product/index.php');
        return true;
    }


    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id){
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])){
            // Если форма отправлена, удаляем товар
            Product::deleteProductById($id);
            // Перенаправление на страницу управления товарами
            header("Location: /admin/product");
        }
        require_once (ROOT.'/views/admin_product/delete.php');
        return true;
    }

}