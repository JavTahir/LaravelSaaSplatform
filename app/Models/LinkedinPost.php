<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinPost extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "linkedin_posts";

    protected $fillable = [
        'user_id',
        'content',
        'images',
        
        
        
    ];

    protected $casts = [
        'images' => 'array',
    ];
}