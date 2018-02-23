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

    /**
     * Action для страницы добавления категорий
     * @return bool
     */
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

    /**
     * Action для страницы "редактирование категорий"
     * @return bool
     */
    public function actionUpdate($id){
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка формы добавления товара
        $category = Category::getCategoryById($id);


        $options=[];
        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];


            // Обновляем категорию
            Category::updateCategoryById($id, $options);
            // Перенаправляем на страницу управления товарами
            header("Location: /admin/category");
        }
        // Подключаем вид
        require_once (ROOT.'/views/admin_category/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete($id){
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])){
            // Если форма отправлена, удаляем товар
            Category::deleteCategoryById($id);
            // Перенаправление на страницу управления товарами
            header("Location: /admin/category");
        }
        require_once (ROOT.'/views/admin_category/delete.php');
        return true;
    }

}