<?php

namespace Models\Repositories;

use Models\Model;

interface RepositoryInterface
{
    public function all(): array;
    public function insert(Model $model): int;

}