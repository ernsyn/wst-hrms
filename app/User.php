<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     *
     */

    protected $table = 'users';

     protected $fillable = [
        'name', 'email', 'password','profile_media_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getId()
    {
        return $this->id;
    }

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    public function medias()
    {
        return $this->belongsTo('App\Media', 'profile_media_id');
    }
}
