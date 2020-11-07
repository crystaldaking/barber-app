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
     * Date Format
     * @var string
     */
    protected $dateFormat = 'H:i:s';

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
        return $this->belongsToMany(Role::class)->orderBy('rank','asc');
    }

    /**
     * Add quene relationshop
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function quene()
    {
        return $this->hasOne(Quene::class);
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
     * Get user rank based on role
     * @return int
     */
    public function getRank()
    {
       return $this->roles()->select('rank')->first()->rank;
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
