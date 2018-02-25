<?php
/**
 * Created 20.02.2018 18:48 by E. Hilevsky
 */

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Регистрация нового пользователя, страница "Регистрация"
     * @return bool
     */
    public function actionRegister(){

        // Переменные для данных из формы
        $name = '';
        $email = '';
        $password = '';
        $result = false;

        // Обработка данных из формы
        if(isset($_POST['submit'])){
            // Если форма отправлена - получаем данные
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Массив ошибок
            $errors =[];

            // Валидация полей
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
                // Если ошибок нет - регистрируем пользователя
                $result = User::register($name, $email, $password);
            }
        }
        // Подключаем вид
        require_once (ROOT.'/views/user/register.php');
        return true;
    }

    /**
     * Авторизация пользователя, страница "Авторизация"
     */
    public function actionLogin(){

        // Переменные для данных из формы
        $email = '';
        $password = '';

        if(isset($_POST['submit'])){
            // Если форма отправлена - получаем данные
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Массив для ошибок
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

    /**
     * Разлогинивание
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout(){

        // Удаляем информацию о пользователе
        unset($_SESSION['user']);
        // Перенаправляем на главную страницу
        header("Location: /");
    }


}