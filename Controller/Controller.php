<?php
declare(strict_types=1);
namespace Controller;
class Controller{
    public function index($file){
        $view = new \Views\Views($file);
    }
}