<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Add User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    protected $table = 'roles';

    protected $fillable = [
        'id',
        'rank',
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getRank()
    {
        return $this->rank;
    }
}
