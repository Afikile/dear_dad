<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    // Include 'allow_comments' in the fillable array
    protected $fillable = ['title', 'body', 'user_id', 'locked', 'view_count', 'pushed_up_at', 'allow_comments'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Comment model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Toggle lock status of the letter
    public function toggleLock()
    {
        $this->locked = !$this->locked;
        $this->save();
    }

    // Define the relationship with the Reply model
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // Get the count of replies for the letter
    public function replyCount()
    {
        return $this->replies()->count();
    }

    // Check if comments are allowed on the letter
    public function canAllowComments()
    {
        return $this->allow_comments;
    }

    // Define the relationship to the User model

}
