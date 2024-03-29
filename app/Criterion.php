<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criterion extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function achievement(){
        return $this->belongsTo("App\Achievement");
    }
}
