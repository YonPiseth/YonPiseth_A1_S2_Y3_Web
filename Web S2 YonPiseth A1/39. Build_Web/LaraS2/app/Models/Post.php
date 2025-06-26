<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    // Cast attributes (optional but useful for clarity or further extension)
    protected $casts = [
        'title' => 'string',
        'body' => 'string',
    ];
}
