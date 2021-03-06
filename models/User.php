<?php
/**
 * Created 20.02.2018 18:48 by E. Hilevsky
 */
/**
 * Класс User - модель для работы с пользователями
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
     * Проверка номера телефона
     * @param string $email имя
     * @return bool
     */
    public static function checkPhone($userPhone){
        if(strlen($userPhone) >= 7){
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

    /**
     * Проверяем, есть ли пользователь с таким email и паролем в БД
     *
     * @param string $email
     * @param string $password
     * @return mixed: integer id пользователя или false
     */
    public static function checkUserData($email, $password){

        $password = md5($password);

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email=:email AND password=:password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if($user){
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя (стартуем сессию)
     * @param integer $userId   - id пользователя
     */
    public static function auth($userId){

        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.
     * Иначе перенаправляет на страницу входа
     * @return integer  -- id пользователя
     */
    public static function checkLogged(){

        // Если сессия существует, получаем Id пользователя
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        //Если нет - перенаправляем на страницу авторизации
        header ("Location: /user/login");
    }

    /**
     * Проверяет, является ли пользователь гостем
     * @return boolean Результат выполнения метода
     */
    public static function isGuest(){

        // Если сессия существует, значит неГость
        if(isset($_SESSION['user'])){
            return false;
        }
        //Если нет - Гость
        return true;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id   -- id пользователя
     * @return array    -- массив с информацией о пользователе
     */
    public static function getUserById($id){

        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            //получаем данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    /**
     * Редактирование данных пользователя в БД
     * @param integer $id   -- id пользователя
     * @param string $name  -- имя пользователя
     * @param string $password  -- пароль
     * @return bool     - результат выполнения
     */
    public static function edit($id, $name, $password){

        // шифруем пароль
        $password = md5($password);

        $db = Db::getConnection();

        $sql = 'UPDATE user SET name=:name, password=:password WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

}