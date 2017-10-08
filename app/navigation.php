<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class navigation extends Model
{
    protected $fillable = [
        'navigation_name', 'parent_id'
    ];

    public function Navigations()
    {
        return $this->belongsTo('App\navigation');
    }
    protected $table = 'navigations';
    protected $primaryKey = 'navigation_id';
}