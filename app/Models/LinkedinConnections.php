<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinConnections extends Model
{
    use HasFactory;

    protected $fillable = [
        'linkedin_id',
        'connections_count',
        'record_date',
    ];

    public function linkedinacc()
    {
        return $this->belongsTo(Linkedin::class, 'linkedin_id');
    }

}
