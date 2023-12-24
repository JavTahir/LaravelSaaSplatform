<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterFollower extends Model
{
    use HasFactory;

    protected $fillable = [
        'twitter_id',
        'followers_count',
        'friends_count',
        'statuses_count',
        'record_date',
    ];

    public function twitteracc()
    {
        return $this->belongsTo(Twitter::class, 'twitter_id');
    }

}
