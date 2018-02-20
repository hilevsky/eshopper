<?php
/**
 * Created 20.02.2018 18:48 by E. Hilevsky
 */

class UserController
{
    /**
     * Регистрация нового пользователя
     * @return bool
     */
    public function actionRegister(){

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors =[];

            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if(!User::checkEmail($email)){
                $errors[] = 'Неправильный E-mail';
            }

            if(!User::checkPassword($password)){
                $errors[] = 'Пароль должен быть не короче 6-и символов';
            }

            if(User::checkEmailExists($email)){
                $errors[] = 'Такой E-mail уже существует';
            }

            if($errors == false){
                $result = User::register($name, $email, $password);
            }

        }

        require_once (ROOT.'/views/user/register.php');

        return true;
    }

    /**
     * Авторизация пользователя
     */
    public function actionLogin(){

        $email = '';
        $password = '';

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Валидация данных, полученных из формы авторизации
            if(!User::checkEmail($email)){
                $errors[] = 'Неправильный E-mail';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-и символов';
            }

            // Проверяем, существует ли пользователь в БД
            $userId = User::checkUserData($email, $password);

            if(!$userId){
                // если пользователя нет - выводим ошибку
                $errors[] = 'Неправильные данные пользователя';
            } else {
                // если пользователь есть - устанавливам сессию
                User::auth($userId);
                // и перенаправляем в закрытую часть сайта - в кабинет пользователя
                header("Location: /cabinet/");
            }
        }
        require_once (ROOT.'/views/user/login.php');

        return true;
    }
}