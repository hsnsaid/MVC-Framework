<?php
declare(strict_types=1);
namespace App_Core;
class Validator{
    public static function string(string $string, int $min=1, int $max=INF){
        $string=trim($string);
        return strlen($string)>=$min && strlen($string)<=$max ;
    }
    public static function email(string $email){
        filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
?>