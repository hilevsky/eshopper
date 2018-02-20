<?php
/**
 * Created 20.02.2018 18:48 by E. Hilevsky
 */

class User
{
    /**
     * Регистрация нового пользователя
     * @param string $name  - имя
     * @param string $email - E-mail
     * @param string $password  - пароль
     * @return bool     - результат выполнения
     */
    public static function register($name, $email, $password){

        $password = md5($password);

        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password)
                VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Проверка имени, не меньше 2-х символов
     * @param string $name имя
     * @return bool
     */
    public static function checkName($name){
        if(strlen($name) >= 2){
            return true;
        }
        return false;
    }


    /**
     * Проверка пароля, не меньше 6-и символов
     * @param string $password имя
     * @return bool
     */
    public static function checkPassword($password){
        if(strlen($password) >= 6){
            return true;
        }
        return false;
    }

    /**
     * Проверка E-mail на соответствие
     * @param string $email имя
     * @return bool
     */
    public static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /**
     * Проверка, есть ли пользователь с таким E-mail (при регистрации пользователя)
     * @param string $email email пользователя
     * @return bool
     */
    public static function checkEmailExists($email){

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email=:email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }





}