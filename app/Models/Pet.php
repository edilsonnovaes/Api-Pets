<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name', 'descricao', 'age', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
