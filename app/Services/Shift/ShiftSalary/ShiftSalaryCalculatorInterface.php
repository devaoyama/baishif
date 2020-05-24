<?php

namespace App\Services\Shift\ShiftSalary;

use App\Shift;

interface ShiftSalaryCalculatorInterface
{
    public function calculate(Shift $shift);
}
