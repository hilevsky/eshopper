<?php
/**
 * Created 21.02.2018 0:23 by E. Hilevsky
 */

/**
 * Class CabinetController
 * Работа с пользователями
 */

class CabinetController
{
    /**
     * Action для страницы пользователя
     * @return bool
     */
    public function actionIndex(){

        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе
        $user = User::getUserById(($userId));

        // Подключаем вид
        require_once (ROOT.'/views/cabinet/index.php');
        return true;
    }

    /**
     * Редактирование данных пользователя (имя и пароль, приходят из формы на странице)
     * @return bool
     */
    public function actionEdit(){

        // Получаем Id пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $result = false;

        if(isset($_POST['submit'])){
            // Если фоарма отправлена - получаем из нее данные
            $name = $_POST['name'];
            $password = $_POST['password'];

            // массив для ошибок
            $errors = false;

            // Валидация данных, полученных из формы авторизации
            if(!User::checkName($name)){
                $errors[] = 'Имя должно быть не короче двух символов';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-и символов';
            }

            if(!$errors){
                $result = User::edit($userId, $name, $password);
            }
        }
        // Подключаем вид
        require_once (ROOT.'/views/cabinet/edit.php');
        return true;
    }

    /**
     * Action для страницы "Список покупок"
     * @param integer $id   -- id заказа
     * @return bool
     */
    public function actionHistory(){

        // Получаем id пользователя
        $userId = $_SESSION['user'];

        // Получаем информацию о пользователе
        $user = User::getUserById(($userId));

        // Получаем данные о заказах (приходит массив массивов)
        $orderList = Order::getOrderListByUser($userId);

        foreach($orderList as $order) {
            // Получаем массив с товарами заказа
            $productsQuantity[$order['id']] = json_decode($order['products'], true);

            // Получаем массив с id товаров
            $productsIds = array_keys($productsQuantity[$order['id']]);

            // Получаем список товаров в заказе
            $products[$order['id']] = Product::getProductsByIds($productsIds);
        }

        // Подключаем вид
        require_once (ROOT.'/views/cabinet/history.php');
        return true;
    }

}