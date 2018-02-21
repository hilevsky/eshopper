<?php include ROOT.'/views/layouts/header.php' ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 padding-right">


                <?php if($result):?>
                    <h3>Данные изменены!</h3>
                <?php else: ?>
                    <?php if(isset($errors) && is_array($errors)):?>
                        <ul>
                            <?php foreach($errors as $error):?>
                                <li> - <?=$error;?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form">

                        <h2>Редактирование данных пользователя</h2>

                        <form action="#" method="post">
                            <p>Имя</p>
                            <input type="name" name="name" placeholder="E-mail" value="<?=$name?>">
                            <p>Пароль</p>
                            <input type="password" name="password" placeholder="Пароль" value="<?=$password?>">
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        </form>

                <?php endif; ?>

                    </div>


                </div>
            </div>
        </div>

    </section>

<?php include ROOT.'/views/layouts/footer.php' ?>