<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'company_id',
        'status',
        'start_at',
        'finish_at',
        'salary',
    ];
}
