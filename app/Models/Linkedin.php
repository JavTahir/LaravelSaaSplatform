<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linkedin extends Model
{
    use  HasFactory;

    public $timestamps = false;
    

    protected $table = "linkedin";

    protected $fillable = [
        'user_id',
        'linkedin_name',
        'linkedin_uname',
        'linkedin_email',
        'linkedin_id',
        'linkedin_type',
        'linkedin_avatar',
        'linkedin_access_token',
        
        
    ];

    public function connections()
    {
        return $this->hasMany(LinkedinConnections::class);
    }
}
