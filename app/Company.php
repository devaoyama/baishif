<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'hourly_rate',
        'holiday_hourly_rate',
        'midnight_hourly_rate_increase_rate',
        'transportation_costs',
    ];
}
