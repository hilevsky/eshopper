<?php
/**
 * Created 23.02.2018 22:39 by E. Hilevsky
 */

/**
 * Class AdminCategoryController
 * Управление категориями товаров в админпанели
 */
class AdminCategoryController extends AdminBase
{
    /**
     * Action для страницы управления категориями
     */
    public function actionIndex(){
        self:self::checkAdmin();

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();

        //Подключаем вид
        require_once (ROOT.'/views/admin_category/index.php');
        return true;
    }

    public function actionCreate(){
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])){
            // Если форма отправлена, получаем из нее данные
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Массив для ошибок
            $errors = [];

            // Валидация полей формы (имя)
            if(!isset($name) || empty($name)){
                $errors[] = 'Заполните поля';
            }

            if(!$errors){
                // Если ошибок нет, создаем новую категорию
                Category::createCategory($name, $sortOrder, $status);

                // Перенаправляем на страницу управления категориями
                header("Location: /admin/category");
            }
        }
        require_once (ROOT.'/views/admin_category/create.php');
        return true;
    }

}