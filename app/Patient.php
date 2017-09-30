<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];


    public function EmailidRole() {
        return $this->belongsTo('App\EmailidRole');
    }
    public function Security() {
        return $this->belongsTo('App\Security');
    }
    protected $table = 'patients';
}