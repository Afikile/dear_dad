<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = ['body', 'user_id', 'letter_id', 'parent_id'];

    // A comment belongs to a letter (the post)
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    // A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A comment may have many replies (comments replying to it)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // A comment may have a parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
