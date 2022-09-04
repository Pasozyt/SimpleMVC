<?php

namespace Models\Repositories;

use PDO;
use Models\Model;
use PDOException;
use Models\Combined;
use Exceptions\DatabaseException;
use Models\Repositories\Repository;

class CombinedRepository extends Repository
{
    protected $table = 'combined';

    public function create(array $arguments): Combined
    {
        return new Combined($arguments);
    }

    public function alljoin(): array
    {
        $result = [];
        try {
            $query = 'SELECT combined.id, city.name, postcode.postcode FROM `combined` INNER JOIN city ON combined.id_city=city.id INNER JOIN postcode ON combined.id_code=postcode.id ORDER BY city.name ASC';
            $stmt = $this->handle->getHandle()->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }
        return $rows;
    }

    // do zrobienia
    public function insert(Model $model): int
    {
        if (!$model instanceof Combined) {
            return -1;
        }
        try {
            
            $query = 'SELECT * FROM `combined` WHERE id_city=:id_city AND id_code=:id_code'; 
            $stmt = $this->handle->getHandle()->prepare($query);
            $stmt->bindValue(':id_city', $model->id_city, PDO::PARAM_STR);
            $stmt->bindValue(':id_code', $model->id_code, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if(count($rows)>0){
                echo "Dana kombinacja istnieje juz";
                exit;
            }
            else{
                $query = 'INSERT INTO `' . $this->table . '`';
                $query .= '(`id_city`,`id_code`)';
                $query .= ' VALUES (:id_city, :id_code)';
                $stmt = $this->handle->getHandle()->prepare($query);
                $stmt->bindValue(':id_city', $model->id_city, PDO::PARAM_STR);
                $stmt->bindValue(':id_code', $model->id_code, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    return $this->handle->getHandle()->lastInsertId();
                }
                return -1;
            }
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