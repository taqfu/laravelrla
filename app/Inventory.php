<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    //
    public function achievement(){
        return $this->belongsTo('App\Achievement');
    }
    public function criterion(){
        return $this->belongsTo('App\Criterion');
    }
}
