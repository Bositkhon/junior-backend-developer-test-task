<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeShift extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime:m.d.Y H:i:s',
        self::UPDATED_AT => 'datetime:m.d.Y H:i:s',
        self::DELETED_AT => 'datetime:m.d.Y H:i:s'
    ];
}
