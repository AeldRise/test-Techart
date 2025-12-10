<?php

namespace App\Core;

use PDO;

class Database
{
    protected static $instance = null;
    protected $connection;

    private function __construct(array $config = NULL)
    {   
        if ($config === NULL){
            $config = require "config/dbConnect.php";
        }
        $dsn = "{$config['db']}:host={$config['host']};dbname={$config['dbname']}";
        $this->connection = new PDO($dsn, $config['login'], $config['password']);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public static function getInstance()
    {
        if (self::$instance === NULL) {
           self::$instance = new self;
        }
        return self::$instance;
    }
}