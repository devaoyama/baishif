<?php

namespace App\Repositories\Shift;

use App\Shift;

interface ShiftRepositoryInterface
{
    public function getAll();

    public function getByDate(Int $year);

    public function getByShareId(string $shareId);

    public function find(Int $id);

    public function create(Shift $shift, array $data);

    public function update(Shift $shift, array $data);

    public function setShareId(Int $year, Int $month);

    public function delete(Shift $shift);

    public function deleteShareId(string $shareId);
}
