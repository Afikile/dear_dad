<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['letter_id', 'user_id', 'body', 'parent_id'];

    // Define the relationship with the Letter model
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the self-referential relationship for the parent reply
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    // Define the self-referential relationship for child replies
    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }
}
