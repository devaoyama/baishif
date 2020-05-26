<?php

namespace App\Repositories\Shift;

use App\Shift;

class ShiftRepository implements ShiftRepositoryInterface
{
    public function getAll()
    {
        return auth()->user()->shifts;
    }

    public function find(Int $id)
    {
        return Shift::find($id);
    }

    public function create(Shift $shift, array $data)
    {
        $shift->fill($data);
        auth()->user()->shifts()->save($shift);
        return $shift;
    }

    public function update(Shift $shift, array $data)
    {
        $shift->fill($data)->save();
        return $shift;
    }

    public function delete(Shift $shift)
    {
        return $shift->delete();
    }
}
