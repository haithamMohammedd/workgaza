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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    function company() {
        return $this->belongsTo(Company::class)->withDefault();
    }

    function skills() {
        return $this->belongsToMany(Skill::class,'user_skill');
    }

    function propsals() {
        return $this->hasMany(Proposal::class);
    }

    function projects() {
        return $this->belongsToMany(Project::class);
    }

    function my_project() {
        return $this->hasMany(UserProject::class);
    }

    function reviews() {
        return $this->hasMany(CompanyReview::class);
    }
}
