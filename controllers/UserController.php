<?php
/**
 * Created 20.02.2018 18:48 by E. Hilevsky
 */

class UserController
{
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
                $errors['name'] = 'Имя не должно быть короче 2-х символов';
            }

            if(!User::checkEmail($email)){
                $errors['email'] = 'Неправильный E-mail';
            }

            if(!User::checkPassword($password)){
                $errors['password'] = 'Пароль должен быть не короче 6-и символов';
            }

            if(User::checkEmailExists($email)){
                $errors['emailExists'] = 'Такой E-mail уже существует';
            }

            if($errors == false){
                $result = User::register($name, $email, $password);
            }

        }

        require_once (ROOT.'/views/user/register.php');

        return true;
    }
}