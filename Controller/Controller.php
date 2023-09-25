<?php
declare(strict_types=1);
namespace Controller;
class Controller{
    public function file($file){
        $view = new \Views\Views($file);
    }
    public function create($file){
        $model=new \Model\Model();
        $id=$model->create($_POST['email']);
        if($id==false){
            $view = new \Views\Views("404");
        }
        session_start();
        $_SESSION['user_id']=$id;
        $_SESSION['status']=true;
        header("Location: $file.html");
    }
    public function check($file){
        $model=new \Model\Model();
        $id=$model->check($_POST['']);
        if($id==false){
            $view = new \Views\Views("404");
            exit();
        }
        session_start();
        $_SESSION['user_id']=$id;
        $_SESSION['status']=true;
        header("Location: $file.html");    
    }
    public function show($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
        }
        else{
        require  __DIR__ . "/../Views/" . "$file.php";
        }
    }
    public function add($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
        }
        else{
        $view = new \Views\Views($file);
        }
    }
    public function delete($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
        }
        else{
        require  __DIR__ . "/../Views/" . "$file.php";
        }
    }
    public function update($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
        }
        else{
        require  __DIR__ . "/../Views/" . "$file.php";
        }
    }
    public function search_post($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
        }
        else{
        require  __DIR__ . "/../Views/" . "$file.php";
        }
    }
	public function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		header('Location: ./');
		exit;
	}
}