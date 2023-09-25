<?php
declare(strict_types=1);
namespace App_Core;
class App{
    public static DB $db;
    public function __construct(protected Route $router, protected array $request, protected Config $config)
    {
        static::$db = new DB($config->db ?? []);
    }
    public static function db(): DB
    {
        return static::$db;
    }
    public function run(){
        $this->router->resolver($this->request["uri"],$this->request["method"]);
    }
}