<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lix extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "lix_accounts";

    protected $fillable = [
        'lix_api_key',
        'linkedin_viewer_id',
        'user_id',
        
        
        
    ];
}
