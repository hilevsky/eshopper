<?php
/**
 * Created 16.02.2018 18:40 by E. Hilevsky
 */



class SiteController{

    public function actionIndex(){

        $categories =[];
        $categories = Category::getCategoriesList();

        $latestProduct = [];
        $latestProduct = Product::getLatestProducts(6);

        require_once(ROOT.'/views/site/index.php');



        return true;
    }

    public function actionContact(){

        $userEmail = '';
        $userText = '';
        $result = false;

        if(isset($_POST['submit'])){

            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if(!USER::checkEmail($userEmail)){
                $errors[] = "Неправильный E-mail";
            }

            if(!$errors){
                $adminEmail = 'e_gilevski@yahoo.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Письмо с сайта!';
                $result = mail($adminEmail, $subject, $message);
            }
        }
        // Нужно бы добавить капчу...

        require_once (ROOT.'/views/site/contact.php');

        return true;
    }
}