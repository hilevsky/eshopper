<?php include ROOT.'/views/layouts/header_admin.php'; ?>
    <section>
        <div class="container">
            <div class="row">
                <br>
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление категориями</li>

                    </ol>
                </div>

                <a href="/admin/сфеупщкн/create" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить категорию</a>

                <h4>Список товаров</h4>

                <br>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Id категории</th>
                        <th>Название категории</th>
                        <th>Порядковый номер</th>
                        <th>Статус</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    <?php foreach($categoriesList as $category): ?>
                        <tr>
                            <td><?=$category['id']?></td>
                            <td><?=$category['name']?></td>
                            <td><?=$category['sort_order']?></td>
                            <td><?=$category['status']?></td>
                            <td><a href="/admin/category/update/<?=$category['id']?>" title="Редактировать"><i class="fa fa-pencil-square"></i></a></td>
                            <td><a href="/admin/category/delete/<?=$category['id']?>" title="Удалить"><i class="fa fa-times"></i></a></td>

                        </tr>
                    <? endforeach;?>
                </table>

            </div>
        </div>
    </section>

<?php include ROOT.'/views/layouts/footer_admin.php'; ?>