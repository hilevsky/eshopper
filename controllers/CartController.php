<?php
/**
 * Created 21.02.2018 19:07 by E. Hilevsky
 */

/**
 * Контроллер CartController
 * Работа с корзинойо товаров
 */
class CartController
{
    /**
     * Action для добавления товара в корзину
     * @param integer $id   -- id товара
     */
    public function actionAdd($id){

        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на исходную страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Action для удаления товара из корзины
     * @param integer $id -- id удаляемого товара
     */
    public function actionDelete($id){

        // Добавляем товар в корзину
        Cart::deleteProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }

    /**
     * Action для изменения пользователем кол-ва товара в корзине
     */
    public function actionCalculate(){

        if(isset($_POST['submit'])) {
            Cart::Calculate();
        }
    }

    /**
     * Action для странциы "Корзина"
     * @return bool
     */
    public function actionIndex(){

        // Список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        // Получаем данные из корзины
        $productsInCart = Cart::getProducts();

        if($productsInCart){
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            // Получаем полную стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        // Подключаем вид
        require_once (ROOT.'/views/cart/index.php');
        return true;
    }

    /**
     * Action для страницы "Оформление покупки"
     * @return bool
     */
    public function actionCheckout(){
        // список категорий для левого меню
        $categories =[];
        $categories = Category::getCategoriesList();

        // Статус успешного оформления заказа
        $result = false;

        // Проверяем, отправлена ли форма
        if(isset($_POST['submit'])){
            // Если форма заполнена - получаем данные
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Валидация полей
            $errors = false;
            if(!User::checkName($userName))
                $errors[] = 'Неправильное имя';
/*            if(!User::checkPhone($userPhone))
                $errors[] = 'Неправильный телефон';
*/
            // Форма заполнена правильно
            if(!$errors){
                // Собираем информацию о заказе
                $productsInCart = Cart::getProducts();
                // Проверяем, является ли пользователь гостем
                if(User::isGuest()){
                    $userId = false;
                } else {
                    // Не гость, получаем информацию о пользователе из БД
                    $userId = User::checkLogged();
                }

                // Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if($result){
                    // Оповещаем администратора о новом заказе
                    $adminEmail = 'e_gilevski@yahoo.com';
                    $message = 'У нас новый заказ!';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $subject, $message);

                    //Очищаем корзину
                    Cart::clear();
                }
            } else {
                // Форма заполнена неправильно
                // Находим общую стоимость,
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                // Количество товаров
                $totalQuantity = Cart::countItems();
            }
        } else {
            // Форма не отправлена

            // Получаем данные из корзины
            $productsInCart = Cart::getProducts();

            //В корзине есть товары?
            if(!$productsInCart){
                // Нет товаров - отправляем на главную искать товары
                header("Location: /");
            } else {
                // В корзине есть товары - да
                // Находим общую стоимость,
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                // Количество товаров
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизован?
                if(!User::isGuest()){
                    // Да - получаем инфу о нем и подставляем в форму
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];
                }
                    // Нет - значения для формы пустые
            }
        }
        require_once (ROOT.'/views/cart/checkout.php');
        return true;
    }

}