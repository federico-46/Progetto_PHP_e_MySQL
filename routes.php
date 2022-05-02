<?php

$router->define([

        
        'Progetto_PHP_e_MySQL' =>'controllers/index.php',
        //orders
        'Progetto_PHP_e_MySQL/order-create' => 'controllers/order/create.php',
        'Progetto_PHP_e_MySQL/order-delete' => 'controllers/order/delete.php',
        'Progetto_PHP_e_MySQL/order-read' => 'controllers/order/read.php',
        'Progetto_PHP_e_MySQL/order-update' => 'controllers/order/update.php',
        //products
        'Progetto_PHP_e_MySQL/product-create' => 'controllers/product/create.php',
        'Progetto_PHP_e_MySQL/product-delete' => 'controllers/product/delete.php',
        'Progetto_PHP_e_MySQL/product-read' => 'controllers/product/read.php',
        'Progetto_PHP_e_MySQL/product-update' => 'controllers/product/update.php',
  
]);
