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
     * Action для страницы "Добавление товара"
     * @return bool
     */
    public function actionCreate(){
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка формы добавления товара
        $categoriesList = Category::getCategoriesListAdmin();

        $options=[];
        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];


            // Ошибки в форме
            $errors = [];


            // Условия для валидации полей
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поле';
            }

            if (!$errors) {
                // Если ошибок нет - добавляем товар
                $id = Product::createProduct($options);
            }

            // Если запись в БД добавлена (id генерируется автоматом)
            if ($id) {
                // Проверим, загружалось ли через форму изображеие
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, то перемещаем его в нужную папку и даем нужное имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }
            // Перенаправляем на страницу управления товарами
            header("Location: /admin/product");
        }
        // Подключаем вид
        require_once (ROOT.'/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для страницы "Добавление товара"
     * @return bool
     */
    public function actionUpdate($id){
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка формы добавления товара
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о редактируемом товаре для заполнения формы
        $product = Product::getProductById($id);

        $options=[];
        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];


            // Если ошибок нет - добавляем товар
            if (Product::updateProductById($id, $options)) {

                // Проверим, загружалось ли через форму изображеие
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, то перемещаем его в нужную папку и даем нужное имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }
            // Перенаправляем на страницу управления товарами
            header("Location: /admin/product");
        }
        // Подключаем вид
        require_once (ROOT.'/views/admin_product/update.php');
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