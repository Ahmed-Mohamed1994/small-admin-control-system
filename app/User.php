<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    protected $date = ['delete_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'image', 'password', 'token', 'image', 'nationality', 'birthDate',
        'type', 'active', 'group_id','email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group(){
        return $this->belongsTo(groups::class);
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }
}
