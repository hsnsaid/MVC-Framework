<?php
namespace App_Core;
class Config{
    private array $config;
    public function __construct(array $env){
        $this->config=
        ["db"=>[
            "driver"=>$env["DRIVER"],
            "host"=>$env["HOST"],
            "user"=>$env["USER"],
            "password"=>$env["PASSWORD"],
            "database"=>$env["DB_NAME"]
            ]
        ];
    }
    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}