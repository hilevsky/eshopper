<?php
/**
 * Created 16.02.2018 18:39 by E. Hilevsky
 */

return array(

    'product/([0-9]+)' => 'product/view/$1',    // actionView в ProductController, товары

    'catalog/page-([0-9]+)' => 'catalog/index/$1/$2', //actionIndex в CatalogController, постраничный вывод товаров
    'catalog'=> 'catalog/index',    //actionIndex в CatalogController

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory в CatalogController, постраничный вывод товаров

    'category/([0-9]+)' => 'catalog/category/$1',   //actionCategory в CatalogController

    'cart/checkout' => 'cart/checkout', // actionAdd в CartController
    'cart/add/([0-9]+)' => 'cart/add/$1',   // actionAdd в CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',   // actionAdd в CartController
    'cart' => 'cart/index',   // actionIndex в CartController

    'user/register' => 'user/register', // actionRegister в UserController
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    'cabinet/edit' => 'cabinet/edit',
    'cabinet' =>'cabinet/index',    // indexAction в CabinetController

    'contacts' => 'site/contact',

    '' => 'site/index',     //actionIndex в SiteController

);