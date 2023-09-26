<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
use App_Core\Route;
use App_Core\App;
use App_Core\Config;
use Controller\Controller;

$route=new Route();
$route->get("/project/note_app/",[Controller::class,"file","signin"]);
$route->get("/project/note_app/login.html",[Controller::class,"file","login"]);
$route->get("/project/note_app/signin.html",[Controller::class,"file","signin"]);
$route->get("/project/note_app/add_note.html",[Controller::class,"file","add_note"]);
$route->get("/project/note_app/Home.html",[Controller::class,"show","Home"]);
$route->get("/project/note_app/logout.html",[Controller::class,"logout"]);

$route->post("/project/note_app/login.html",[Controller::class,"check","Home"]);
$route->post("/project/note_app/",[Controller::class,"create","Home"]);
$route->post("/project/note_app/signin.html",[Controller::class,"create","Home"]);
$route->post("/project/note_app/add_note.html",[Controller::class,"add","add_note"]);
$route->post("/project/note_app/upadate.html",[Controller::class,"search_post","search"]);
$route->post("/project/note_app/delete.html",[Controller::class,"search_post","search"]);

(new App($route,
["uri" =>$_SERVER["REQUEST_URI"] ,"method"=> $_SERVER["REQUEST_METHOD"]]
,new Config($_ENV)))->run();