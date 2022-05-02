<?php

require 'core/database/database.php';
require 'core/database/Order.php';
require 'core/database/Product.php';

include 'core/Router.php';
include 'core/Request.php';

 $fileContent = file(__DIR__.'/.env');
  foreach($fileContent as $envVar){
         putenv(trim($envVar));
       
       } 

require Router::load('routes.php')->direct(Request::uri());
