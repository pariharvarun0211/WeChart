<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient_record_status extends Model
{
     protected $fillable = [
        'patient_record_status'
    ];

    public function patient() {
        return $this->hasMany('App\patient');
    }
    protected $table = 'patient_record_status';
}
