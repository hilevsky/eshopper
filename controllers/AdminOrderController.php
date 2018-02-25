<?php
/**
 * Created 24.02.2018 0:23 by E. Hilevsky
 */

/**
 * Class AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase{

    /**
     * Action для страницы "Управление заказами"
     * @return bool
     */
    public function actionIndex(){
        self::checkAdmin();

        // Получаем список заказов
        $orderList = Order::getOrderList();

        // Подключаем вид
        require_once (ROOT.'/views/admin_order/index.php');
        return true;
    }

    /**
     * Action ля страницы "Удалить заказ"
     * @param $id
     * @return bool
     */
    public function actionDelete($id){
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])){
            // Если форма пришла, удаляем заказз
            Order::deleteOrderById($id);
            // Перенаправляем на страницу управления заказами
            header("Location: /admin/order");
        }
        require_once (ROOT.'/views/admin_order/delete.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     * @param integer $id   -- id заказа
     * @return bool
     */
    public function actionView($id){
        self::checkAdmin();

        // Получаем данные о просматриваемом заказе
        $order = Order::getOrderById($id);

        // Получаем массив с товарами заказа
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с id товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductsByIds($productsIds);

        // Подключаем вид
        require_once (ROOT.'/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     * @param $id
     * @return bool
     */
    public function actionUpdate($id){
        self::checkAdmin();

        // Получаем данные о просматриваемом заказе
        $order = Order::getOrderById($id);

        // Обработка формы
        if(isset($_POST['submit'])){
            // Если форма отправлена, получаем данные
            $userName = $_POST['userName'];
            $userPhone =$_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Сохраняем изменения в БД
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Перенаправляем на страницу управления заказами
            header("Location: /admin/order/view/$id");
        }
        // Подключаем вид
        require_once (ROOT.'/views/admin_order/update.php');
        return true;
    }
}