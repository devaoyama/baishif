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
        'break_minutes',
        'salary',
    ];

    protected $casts = [
        'company_id' => 'integer',
        'status' => 'integer',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
