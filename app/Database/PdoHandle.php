<?php

namespace Database;

use Exceptions\DatabaseException;
use PDO;
use PDOException;
use Services\Logger\Log;

class PdoHandle implements HandleInterface
{
    private $pdo = null;

    public function __construct() 
    {
        try {
            $this->pdo = new PDO(
                config('database.type')
                    . ':host=' . config('database.hostname')
                    . ';dbname=' . config('database.database')
                    . ';port=' . config('database.port')
                    . ';charset=' . config('database.charset'),
                config('database.user'),
                config('database.password')
            );
          } catch(PDOException $e) {
            $this->pdo = null;
            throw new DatabaseException($e);
          }
    }

    public function getHandle()
    {
        return $this->pdo;
    }
}