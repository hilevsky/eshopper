<?php
/**
 * Created 16.02.2018 18:39 by E. Hilevsky
 */

return array(

    'product/([0-9]+)' => 'product/view/$1',    // actionView в ProductController, товары

    'catalog'=> 'catalog/index',    //actionIndex в CatalogController

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory в CatalogController, постраничный вывод товаров
    'category/([0-9]+)' => 'catalog/category/$1',   //actionCategory в CatalogController
    '' => 'site/index',     //actionIndex в SiteController

);