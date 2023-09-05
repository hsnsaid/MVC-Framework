<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
use App_Core\Route;
use App_Core\App;
use App_Core\Config;
use Controller\Controller;

$route=new Route();
$route->get("/project/MVC_Frameworks/home.php",[Controller::class,"index","Home"]);
$route->get("/project/MVC_Frameworks/",[Controller::class,"index","Home"]);
$route->post("/project/MVC_Frameworks/form.php",[Controller::class,"index","Home"]);
$route->delete("/project/MVC_Frameworks/profile.php",[Controller::class,"index"]);
$route->get("/project/MVC_Frameworks/form.php",[Controller::class,"index","Home"]);

(new App($route,
["uri" =>$_SERVER["REQUEST_URI"] ,"method"=> $_SERVER["REQUEST_METHOD"]]
,new Config($_ENV)))->run();