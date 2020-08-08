<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_title',
        'cost',
        'project_type',
        'date',
        'time_shift_id',
        'company_id',
        'duty_holder_full_name'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    /**
     * Relations
     */

    public function timeShift()
    {
        return $this->belongsTo(TimeShift::class, 'time_shift_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
