<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* => Función empresas OneToMany */
    public function empresas()
    {
        return $this->hasMany('App\Empresa','id_user','id');
    }

    public function empleado()
    {
        return $this->hasOne('App\Empleado','id_user');
    }
}
