<?php

namespace Models\Repositories;

use Database\HandleInterface;
use Exceptions\DatabaseException;
use Models\Model;
use Models\Repositories\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    protected $handle;

    protected $table = '';

    public function __construct(HandleInterface $handle)
    {
        $this->handle = $handle;
    }

    abstract public function create(array $arguments): Model;

    public function all(): array
    {
        $result = [];
        try {
            $query = 'SELECT * FROM `' . $this->table . '`';
            $stmt = $this->handle->getHandle()->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $result[] = $this->create($row);
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }
        return $result;
    }    
}