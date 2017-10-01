<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class patient extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'gender', 'age','height','visit_date','is_archived', 'module_id','patient_record_status_id'
    ];


    public function module() {
        return $this->belongsTo('App\module');
    }
    public function patient_record_status() {
        return $this->belongsTo('App\patient_record_status');
    }
    protected $table = 'patient';
}