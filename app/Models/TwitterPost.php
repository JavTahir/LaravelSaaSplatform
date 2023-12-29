<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterPost extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "twitter_posts";

    protected $fillable = [
        'user_id',
        'content',
        'images',
        
        
        
    ];

    protected $casts = [
        'images' => 'array', // Cast the 'images' attribute to an array
    ];
}