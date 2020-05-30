<?php

namespace App\Repositories\Shift;

use App\Services\Shift\ShiftSalary\ShiftSalaryCalculatorInterface;
use App\Shift;

class ShiftRepository implements ShiftRepositoryInterface
{
    private $calculator;

    public function __construct(ShiftSalaryCalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    public function getAll()
    {
        return auth()->user()->shifts;
    }

    public function getByDate($year)
    {
        return Shift::where('user_id', '=', auth()->user()->id)->whereYear('start_at', '=', $year)->with('company')->get();
    }

    public function getByShareId(string $shareId)
    {
        return Shift::where('share_id', '=', $shareId)->with('company')->get();
    }

    public function find(Int $id)
    {
        return Shift::find($id);
    }

    public function create(Shift $shift, array $data)
    {
        $shift->fill($data);
        $this->calculator->calculate($shift);
        auth()->user()->shifts()->save($shift);
        return $shift;
    }

    public function update(Shift $shift, array $data)
    {
        $shift->fill($data);
        $this->calculator->calculate($shift);
        $shift->save();
        return $shift;
    }

    public function setShareId($year, $month)
    {
        $shifts = Shift::where('user_id', '=', auth()->user()->id)->whereYear('start_at', '=', $year)->whereMonth('start_at', '=', $month)->get();
        $id = str_random();
        foreach ($shifts as $shift) {
            $shift->share_id = $id;
            $shift->save();
        }

        if ($shifts->count() === 0) {
            return 400;
        }

        return $id;
    }

    public function deleteShareId(string $shareId)
    {
        $shifts = Shift::where('user_id', '=', auth()->user()->id)->where('share_id', '=', $shareId)->get();
        foreach ($shifts as $shift) {
            $shift->share_id = null;
            $shift->save();
        }
        return $shifts;
    }

    public function delete(Shift $shift)
    {
        return $shift->delete();
    }
}
