<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
