<?php
declare(strict_types=1);
namespace Views;
class Views{
    public function __Construct($file,$ext="html"){
        require "$file.$ext";
    }
}