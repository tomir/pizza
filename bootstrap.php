<?php

error_reporting(E_ERROR);
ini_set('display_errors', 1);

require_once "vendor/autoload.php";
require_once "config.php";

require_once 'application/Load.class.php';
require_once 'application/Controller.abstract.php';
require_once 'application/Backend.class.php';
require_once 'application/Frontend.class.php';
require_once 'model/Product.class.php';
require_once 'model/Attr.class.php';
require_once 'model/Categories.class.php';
require_once 'model/Repository/ProductRepository.class.php';
require_once 'model/Repository/AttrRepository.class.php';
require_once 'model/Repository/CategoriesRepository.class.php';
require_once 'model/Service/Import.class.php';