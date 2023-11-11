<?php
declare(strict_types=1);
namespace Controller;
use App_core\SessioManger;
class Controller{
    public function file($file){
        $view = new \Views\Views($file);
    }
    public function create($file){
        $user=new \Model\Model();
        $id=$user->create($_POST['email'],$_POST['password']);
        if($id==false){
            $view = new \Views\Views("404");
        }
        session_start();
        $_SESSION['user_id']=$id;
        $_SESSION['status']=true;
        header("Location: $file.html");
    }
    public function check($file){
        $user=new \Model\Model();
        $id=$user->check($_POST['email'],$_POST['password']);
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
            exit();
        }
        else{
        $note=new \Model\Model();
        $data=$note->show($_SESSION['user_id']);
        $category=$note->show_category($_SESSION['user_id']);
        $view = new \Views\Views($file,["category"=>$category,"data"=>$data]);
        }
    }
    public function add($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
            exit();
        }
        else{
        $note=new \Model\Model();
        $id=$note->add($_POST['category'],$_POST['date'],$_POST['content'],$_SESSION['user_id'],$_POST['title']);
        $view = new \Views\Views($file);
        }
    }
    public function delete($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
            exit();
        }
        else{
        $note=new \Model\Model();
        $note->delete($_GET['id']);
        $data=$note->show($_SESSION['user_id']);
        $category=$note->show_category($_SESSION['user_id']);
        $view = new \Views\Views($file,["category"=>$category,"data"=>$data]);
        }
    }
    public function update($file){
        session_start();
        if(!isset($_SESSION['status'])){
            header("Location: signin.html");    
            exit();
        }
        else{
        $note=new \Model\Model();
        $data=$note->update($_GET['id'],$_GET['status']);
        $data=$note->show($_SESSION['user_id']);
        $category=$note->show_category($_SESSION['user_id']);
        $view = new \Views\Views($file,["category"=>$category,"data"=>$data]);
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