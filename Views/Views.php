<?php
declare(strict_types=1);
namespace Views;
class Views{
    public function __Construct(string $file,$data=[]){
        require "$file.php";
    }
}