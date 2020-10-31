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
        'name',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add role relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Add quene relationshop
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function quene()
    {
        return $this->hasMany(Quene::class);
    }

    /**
     * Check any role
     * @param $roles Role
     * @return boolean
     */
    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name',$roles)->first()){
            return true;
        }

        return false;
    }

    /**
     * Check role
     * @param $roles Role
     * @return boolean
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name',$role)->first()){
            return true;
        }

        return false;
    }


}
