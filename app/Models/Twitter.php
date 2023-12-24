<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    use  HasFactory;

    public $timestamps = false;
    

    protected $table = "twitter";

    protected $fillable = [
        'user_id',
        'twitter_name',
        'twitter_uname',
        'twitter_email',
        'twitter_id',
        'twitter_type',
        'twitter_avatar',
        'twitter_access_token',
        'twitter_token_secret',
        
        
    ];


    public function followers()
    {
        return $this->hasMany(TwitterFollower::class);
    }
}
