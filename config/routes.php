<?php
/**
 * Created 16.02.2018 18:39 by E. Hilevsky
 */

return array(

    // Товар
    'product/([0-9]+)' => 'product/view/$1',    // actionView в ProductController, товары

    // Каталог
    'catalog/page-([0-9]+)' => 'catalog/index/$1/$2', //actionIndex в CatalogController, постраничный вывод товаров
    'catalog'=> 'catalog/index',    //actionIndex в CatalogController

    // Категории товаров
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory в CatalogController, постраничный вывод товаров
    'category/([0-9]+)' => 'catalog/category/$1',   //actionCategory в CatalogController

    // Корзина товаров
    'cart/checkout' => 'cart/checkout', // actionCheckout в CartController
    'cart/calculate' => 'cart/calculate', // actionCalculate в CartController
        'cart/delete/([0-9]+)' => 'cart/delete/$1',   // actionDelete в CartController
    'cart/add/([0-9]+)' => 'cart/add/$1',   // actionAdd в CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',   // actionAdd в CartController
    'cart' => 'cart/index',   // actionIndex в CartController

    // Пользователь
    'user/register' => 'user/register', // actionRegister в UserController
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/history' => 'cabinet/history',
    'cabinet' =>'cabinet/index',    // indexAction в CabinetController

    // Управление товарами:
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    // Управление категориями:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    // Управление заказами:
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',

    // Админпанель
    'admin'=> 'admin/index',    //actionIndex в AdminController

    // О магазине
    'contacts' => 'site/contact',
    'about' => 'site/about',

    //Главная страница
    '' => 'site/index',     //actionIndex в SiteController

);