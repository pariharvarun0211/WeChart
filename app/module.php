<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class module extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name','is_archived'
    ];


    public function patients() {
        return $this->belongsTo('App\patient');
    }

    protected $table = 'module';
}