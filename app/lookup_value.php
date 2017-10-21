<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class lookup_value extends Model
{
    use Eloquence;
    protected $searchableColumns = ['lookup_value'];

    protected $table = "lookup_value";
    protected $primaryKey ='lookup_value_id';
}
