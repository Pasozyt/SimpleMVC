<?php

namespace Models\Repositories;

use PDO;
use Models\Model;
use PDOException;
use Models\City;
use Exceptions\DatabaseException;
use Models\Repositories\Repository;

class CityRepository extends Repository
{
    protected $table = 'city';

    public function create(array $arguments): City
    {
        return new City($arguments);
    }

    public function insert(Model $model): int
    {
        if (!$model instanceof City) {
            return -1;
        }
        try {
            $query = 'INSERT INTO `' . $this->table . '`';
            $query .= '(`name`)';
            $query .= ' VALUES (:name)';
            $stmt = $this->handle->getHandle()->prepare($query);
            $stmt->bindValue(':name', $model->name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $this->handle->getHandle()->lastInsertId();
            }
            return -1;
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }
    }

    public function delete($id){
        try {
            $query = 'DELETE FROM `' . $this->table . '`';
            $query .= ' WHERE id='.$id.';';
            $stmt = $this->handle->getHandle()->prepare($query);
            try{
                $stmt->execute();
            }catch (\Exception $e)
            {
               echo "Sorki ale musisz usunąć najpierw połączone kody pocztowe do tego miasta";
                exit;
            }
            if ($stmt->execute()) {
                return $this->handle->getHandle()->lastInsertId();
            }
            return -1;
        } catch (PDOException $e) {

            throw new DatabaseException($e);
        }
    }
}