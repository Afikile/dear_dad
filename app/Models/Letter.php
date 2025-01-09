<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 
        'is_approved',
        'user_id', // Add user_id
        'username', // Add username
    ];

    // Relationship with comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
