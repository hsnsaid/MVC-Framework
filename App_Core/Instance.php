<?php

namespace App_Core;

abstract class Instance
{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }
}