<?php
declare(strict_types=1);
namespace Views;
class Views{
    private $dir= __DIR__ . "/../UIs/";
    public function __Construct($file){
        require $this->dir . "$file.html";
    }
    
}