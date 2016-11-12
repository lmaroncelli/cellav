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
        'name', 'email', 'password', 'ruolo','indirizzo', 'citta', 'cap', 'provincia',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function carrelli()
        {
        return $this->hasMany('App\Carrello','user_id','id');
        }

    public function ordini()
        {
        return $this->hasMany('App\Ordine','user_id','id');
        }
}
