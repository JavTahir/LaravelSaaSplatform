<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'city',
        'dob',
        'country',
        'image_path',
        'profile_completed',
        'social_accounts',
        'plan_limit',
        'plan_name',
        'plan_date',
        'last_renewal_date'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function linkedin()
    {
        return $this->hasOne(Linkedin::class, 'user_id');
    }


    public function twitter()
    {
        return $this->hasOne(Twitter::class, 'user_id');
    }




    public function lix()
    {
        return $this->hasOne(Lix::class, 'user_id');
    }


    public function twitterPosts()
    {
        return $this->hasMany(TwitterPost::class, 'user_id');
    }

    // Define the relationship with LinkedinPosts
    public function linkedinPosts()
    {
        return $this->hasMany(LinkedinPost::class, 'user_id');
    }


}
