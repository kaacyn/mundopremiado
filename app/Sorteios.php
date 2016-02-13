<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteios extends Model
{
	public $timestamps = false;

	public function premios()
	{
	    return $this->hasOne('App\Premios','sort_id','id');
	}



   // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($sorteio) { // before delete() method call this
           
        	echo $sorteio."este";
        	
             $sorteio->premios()->delete();
             // do the rest of the cleanup...
        });
    }
}


