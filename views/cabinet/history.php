<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">






                <h4>Просмотр заказов пользователя <?=$user['name']?></h4>
                <br/>

                <?php foreach($orderList as $order):?>


                <h5>Заказ № <?= $order['id']; ?></h5>
                <table class="table-admin-small table-bordered table-striped table">

                    <tr>
                        <td>Телефон клиента</td>
                        <td><?= $order['user_phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Комментарий клиента</td>
                        <td><?= $order['user_comment']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Статус заказа</b></td>
                        <td><?= Order::getStatusText($order['status']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Дата заказа</b></td>
                        <td><?= $order['date']; ?></td>
                    </tr>
                </table>

               <h5>Заказанные товары</h5>

                <table class="table-admin-medium table-bordered table-striped table ">
                    <tr>
                        <th>ID товара</th>
                        <th>Артикул товара</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    <?php foreach ($products[$order['id']] as $product): ?>
                        <tr>
                            <td><?= $product['id']; ?></td>
                            <td><?= $product['code']; ?></td>
                            <td><?= $product['name']; ?></td>
                            <td>$<?= $product['price']; ?></td>
                            <td><?=$productsQuantity[$order['id']][$product['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>


                    <hr color="black">

                <?php endforeach;?>

                <a href="/cabinet/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>


    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>