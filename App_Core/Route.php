<?php
declare(strict_types=1);
namespace App_Core;
class Route{
    private array $route=[];
    private function register(string $url,string $method,array $action):self{
        $this->route[$url][$method]=$action;
        return $this;   
    }
    public function get(string $url,array $action):self{
        return $this->register("$url","GET",$action);
    }
    public function post(string $url,array $action):self{
        return $this->register("$url","POST",$action);
    }
    public function delete(string $url,array $action):self{
        return $this->register("$url","DELETE",$action);
    }
    public function put(string $url,array $action):self{
        return $this->register("$url","PUT",$action);
    }
    public function update(string $url,array $action):self{
        return $this->register("$url","UPDATE",$action);
    }
    public function resolver(string $url,string $request_method){
        $url=parse_url($url)["path"];
        $action=$this->route[$url][$request_method] ?? null;
        if(!$action){
            $this->abort();
        }
        if(count($action)>2){
            [$class,$method,$file]=$action;
        }
        else{
            [$class,$method]=$action;
            $file=null;
        }
        if(!class_exists($class)){
            $this->abort();
        }
        $true_class=new $class();

        if(!method_exists($true_class,$method)){
            $this->abort();
        }
        if(!$file){
                return call_user_func_array([$true_class, $method],[]);
        }
        else{
            return call_user_func_array([$true_class, $method], [$file]);
        }
    }
    private function abort(int $code=404){
        http_response_code($code);
        require __DIR__ . "/../UIs/404.html";
        die();
    }
}