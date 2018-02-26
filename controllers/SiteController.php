<?php
/**
 * Created 16.02.2018 18:40 by E. Hilevsky
 */

/**
 * Контролле SiteController
 */

class SiteController{

    /**
     * Action для главной страницы
     * @return bool
     */
    public function actionIndex(){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProduct = [];
        $latestProduct = Product::getLatestProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        // Подключаем вид
        require_once(ROOT.'/views/site/index.php');
        return true;
    }

    /**
     * Action для страницы "Контакты"
     * @return bool
     */
    public function actionContact(){

        // Переменные для данных из формы
        $userEmail = '';
        $userText = '';
        $result = false;

        // Обработка формы
        if(isset($_POST['submit'])){

            // Если форма отправлена - получаем данные
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // массив ошибок
            $errors = false;

            // Валидация полей формы
            if(!User::checkEmail($userEmail)){
                $errors[] = "Неправильный E-mail";
            }

            if(!$errors){
                // Если ошибок нет - отправляем письмо администратору
                $adminEmail = 'e_gilevski@yahoo.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Письмо с сайта!';
                $result = mail($adminEmail, $subject, $message);
            }
        }
        // Нужно бы добавить капчу...

        // Подключаем вид
        require_once (ROOT.'/views/site/contact.php');

        return true;
    }

    /**
     * Action для страницы "О магазине"
     * @return bool
     */
    public function actionAbout(){
        require_once (ROOT.'/views/site/about.php');
        return true;
    }
}