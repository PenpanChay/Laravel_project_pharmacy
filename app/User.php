<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password','birth', 'age', 'sex', 'disease', 'drug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function isRole(){
        return $this->role;
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
