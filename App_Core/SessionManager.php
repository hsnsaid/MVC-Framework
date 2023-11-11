<?php
namespace App_Core;
trait SessionManger{
    private function isAuthentified(){
        session_start();
        if (!(isset($_SESSION) && isset($_SESSION['status']))) {
            header("Location: signin.html");    
            exit();        
        }
    }
}