<?php

session_start();

define("IS_DEV", TRUE);
define("ROOT", "/taskManager");
define("CONTROLLER_PATH", "controllers/");
define("MODEL_PATH", "models/");
define("VIEW_PATH", "views/");
define("SERVICES", "services/");
define("BASE_URL", IS_DEV ? 'taskManager/' : '/');

require_once("db.php");
require_once("taskConfigs.php");
require_once("Router.php");
require_once SERVICES . "Pager.php";
require_once MODEL_PATH. 'Model.php';
require_once VIEW_PATH. 'View.php';
require_once CONTROLLER_PATH. 'Controller.php';

$router = new Router();
$router->route();
