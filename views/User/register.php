<?php include ROOT.'/views/layouts/header.php' ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <?php if($result): ?>
                            <p>Вы зарегистрированы!</p>
                    <?php else: ?>

                    <?php if(isset($errors) && is_array($errors)):?>
                        <ul>
                            <?php foreach($errors as $error):?>
                                <li> - <?=$error;?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form">

                        <h2>Регистрация на сайте</h2>

                        <form action="#" method="post">
                            <p>Имя</p>
                            <input type="text" name="name" placeholder="Имя" value="<?=$name?>">
                            <p>E-mail</p>
                            <input type="e-mail" name="email" placeholder="E-mail" value="<?=$email?>">
                            <p>Пароль</p>
                            <input type="password" name="password" placeholder="Пароль" value="<?=$password?>">
                            <input type="submit" name="submit" class="btn btn-default" value="Регистрация">
                        </form>



                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </section>

<?php include ROOT.'/views/layouts/footer.php' ?>