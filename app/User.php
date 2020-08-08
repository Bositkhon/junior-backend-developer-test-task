<?php

namespace App;

use App\Traits\DateFormatTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:m.d.Y H:i:s',
        self::CREATED_AT => 'datetime:m.d.Y H:i:s',
        self::UPDATED_AT => 'datetime:m.d.Y H:i:s',
        self::DELETED_AT => 'datetime:m.d.Y H:i:s'
    ];

    /**
     * Mutators
     */

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Relations
     */

    public function companies()
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }

    public function events()
    {
        return $this->hasManyThrough(Event::class, Company::class, 'user_id', 'company_id', 'id', 'id');
    }
    
}
