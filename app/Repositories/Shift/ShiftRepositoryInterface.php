<?php

namespace App\Repositories\Shift;

use App\Shift;

interface ShiftRepositoryInterface
{
    public function getAll();

    public function find(Int $id);

    public function create(Shift $shift, array $data);

    public function update(Shift $shift, array $data);

    public function delete(Shift $shift);
}
