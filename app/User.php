<?php

namespace App;

use App\Notifications\ResetPasswordPicapino;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'second_name', 'last_name', 'second_last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'roles_users', 'user_id', 'rol_id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function profile_images()
    {
        return $this->hasMany('App\ProfileImage');
    }

    public function hasRoles(array $roles)
    {

        foreach ($roles as $role) {
            foreach ($this->roles as $userDbRol) {
                if ($userDbRol->name === $role) {
                    return true;
                }
            }
        }
        return false;
        // return $this->hasMany('App\RolesUser');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordPicapino($token));
    }
}
