<?php include ROOT.'/views/layouts/header.php' ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 padding-right">


                    <?php if($result):?>
                        <h3>Сообщение отправлено! Мы ответим вам на указанный E-mail</h3>
                    <?php else: ?>
                    <?php if(isset($errors) && is_array($errors)):?>
                        <ul>
                            <?php foreach($errors as $error):?>
                                <li> - <?=$error;?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form">

                        <h2>Обратная связь</h2>
                        <h5>Есть вопрос? Напишите нам!</h5>

                        <form action="#" method="post">
                            <p>Ваш E-mail:</p>
                            <input type="email" name="userEmail" placeholder="E-mail" value="<?=$userEmail?>">
                            <p>Сообщение:</p>
                            <textarea name="userText" placeholder="Сообщение" value="<?=$userText?>" rows="5"></textarea>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить">
                        </form>

                        <?php endif; ?>

                    </div>


                </div>
            </div>
        </div>

    </section>

<?php include ROOT.'/views/layouts/footer.php' ?>