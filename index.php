<?php
session_start();

/**
 * Configuration
 */
require_once "Configs/Config.php";
\Configs\Config::getInst()->config();



//Autoloading
require_once 'Sol/Core/Autoload.php';


//Routing
if (isset($_GET["route"])) {
    $router = new \Sol\Mvc\Controllers\SimpleRouter($_GET["route"]);
    $router->hdlReq();
}
