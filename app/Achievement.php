<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function owner (){
        return $this->belongsTo("App\User", "owner_id");
    }
}
