<?php
/**
 * Created 16.02.2018 23:50 by E. Hilevsky
 */

class ProductController
{
    public function actionView($id){

        require_once (ROOT.'/views/product/view.php');
        return true;
    }
}