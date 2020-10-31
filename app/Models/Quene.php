<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quene extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quene';

    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'complete' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
