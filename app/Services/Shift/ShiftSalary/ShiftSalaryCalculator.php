<?php


namespace App\Services\Shift\ShiftSalary;


use App\Shift;

class ShiftSalaryCalculator implements ShiftSalaryCalculatorInterface
{
    public function calculate(Shift $shift): void
    {
        // 基本給
        $startAt = new \DateTime($shift->start_at);
        $finishAt = new \DateTime($shift->finish_at);
        $breakTime = $shift->break_minutes;
        $diff = $finishAt->diff($startAt);
        $minutes = $diff->i;
        $minutes += $diff->h * 60;
        $minutes -= $breakTime;
        $hour = $minutes / 60;

        $company = $shift->company;
        $hourly = $company->hourly_rate;
        $hourlyHoliday = $company->holiday_hourly_rate;
        $salary = $hour * $hourly;

        // 土日給料
        if ($hourlyHoliday) {
            if ($startAt->format('w') === '0' || $startAt->format('w') === '6') {
                $salary += ($hourlyHoliday - $hourly) * $hour;
            }
        }

        // 深夜給料
        if ($increase_rate = $company->midnight_hourly_rate_increase_rate) {

            $midnight_start = new \DateTime($startAt->format('Y-m-d').' 22:00:00');

            $midnight_end = new \DateTime($startAt->format('Y-m-d').' 05:00:00');

            if ($startAt->format('h') >= 5) {
                $midnight_end->modify('+24 hours');
            }

            if ($midnight_start <= $finishAt && $midnight_end >= $startAt) {

                if ($startAt < $midnight_start && $finishAt > $midnight_end) {
                    $midnight_hour = 7;
                    $salary += $midnight_hour * ($hourly * ($increase_rate/100));
                }

                if ($startAt >= $midnight_start && $finishAt <= $midnight_end) {
                    $midnight_hour = $hour;
                    $salary += $midnight_hour * ($hourly * ($increase_rate/100));
                }

                if ($startAt < $midnight_start && $finishAt <= $midnight_end) {
                    $diff_midnight = $midnight_start->diff($finishAt);
                    $midnight_hour = $diff_midnight->h + $diff_midnight->i / 60;
                    $salary += $midnight_hour * ($hourly * ($increase_rate/100));
                }

                if ($startAt >= $midnight_start && $finishAt > $midnight_end) {
                    $diff_midnight = $midnight_end->diff($startAt);
                    $midnight_hour = $diff_midnight->h + $diff_midnight->i / 60;
                    $salary += $midnight_hour * ($hourly * ($increase_rate/100));
                }
            }
        }

        $shift->salary = $salary;
    }
}
