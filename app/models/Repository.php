<?php

namespace App\Models;

use App\Core\Validator;
use App\Core\Database;

use PDO;

abstract class Repository
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb(Database $database)
    {
        $this->db = $database->getConnection();
    }

    protected function getByQuery($query, $params = [])
    {
        $stmt = $this->db->prepare($query);
        $params = Validator::prepareArrayToDbRequest($params);
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}