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
}