<?php
/**
 * Created 16.02.2018 18:40 by E. Hilevsky
 */

class SiteController{

    public function actionIndex(){

        require_once(ROOT.'/views/site/index.php');



        return true;

    }
}