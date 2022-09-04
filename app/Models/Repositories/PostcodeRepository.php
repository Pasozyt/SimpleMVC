<?php

namespace Models\Repositories;

use PDO;
use Models\Model;
use PDOException;
use Models\Postcode;
use Exceptions\DatabaseException;
use Models\Repositories\Repository;

class PostcodeRepository extends Repository
{
    protected $table = 'postcode';

    public function create(array $arguments): Postcode
    {
        return new Postcode($arguments);
    }

    public function insert(Model $model): int
    {
        if (!$model instanceof Postcode) {
            return -1;
        }
        try {
            $query = 'INSERT INTO `' . $this->table . '`';
            $query .= '(`postcode`)';
            $query .= ' VALUES (:postcode)';
            $stmt = $this->handle->getHandle()->prepare($query);
            $stmt->bindValue(':postcode', $model->postcode, PDO::PARAM_STR);
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