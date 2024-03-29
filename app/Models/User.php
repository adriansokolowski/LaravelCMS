<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
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
        'email_verified_at' => 'datetime',
    ];

    public function getIsUploaderAttribute()
    {
        return $this->role_id == 2;
    }

    public function getIsModeratorAttribute()
    {
        return $this->role_id == 3;
    }

    public function getIsAdminAttribute()
    {
        return $this->role_id == 4;
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function xxxtoday()
    {
        return 1;
    }
}
