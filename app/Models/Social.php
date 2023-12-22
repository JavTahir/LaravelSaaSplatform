<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'social_name',
        'social_uname',
        'social_email',
        'social_id',
        'social_type',
        'social_avatar',
        
        
    ];
}
