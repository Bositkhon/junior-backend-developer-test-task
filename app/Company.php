<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
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

    /**
     * Relations
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'company_id', 'id');
    }

}
