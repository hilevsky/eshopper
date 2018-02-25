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
     */
    public function actionView($id){
        self::checkAdmin();

        // Получаем данные о просматриваемом заказе
        $order = Order::getOrderById($id);

        // Получаем массив с товарами заказа
        $productQuantity = json_decode($order['products'], true);

        // Получаем массив с id товаров
        $productsIds = array_keys($productQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductsByIds($productsIds);

        // Подключаем вид
        require_once (ROOT.'/views/admin_order/view.php');
        return true;
    }
}