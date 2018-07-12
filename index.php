<?php
//imporatando el contenido de otro archivo
require_once "controllers/CategoriesController.php";
require_once "controllers/CustomersController.php";
require_once "controllers/ProductsController.php";
require_once "controllers/SalesController.php";
require_once "controllers/TemplateController.php";
require_once "controllers/UsersController.php";

require_once "models/Categories.php";
require_once "models/Customers.php";
require_once "models/Products.php";
require_once "models/Sales.php";
require_once "models/Users.php";

//Instanciamos Plantillacontroller en una variable 
$template = new TemplateController();
$template->ctrTemplate();
