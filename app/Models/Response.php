<?php

// app/Models/Response.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['letter_id', 'content', 'user_id'];

    // Define the relationship between Response and Letter (assuming a response belongs to a letter)
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}

