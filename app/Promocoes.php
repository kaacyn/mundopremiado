<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocoes extends Model
{

	public function setTituloAttribute($value)
	{
		$this->attributes['titulo'] = $value;

		if (! $this->exists) {
		  $this->attributes['slug'] = str_slug($value);
		}
	}


    public function premios()
    {
        return $this->hasOne('App\Premios','prom_id','id');
    }


    public function sorteios()
    {
        return $this->hasOne('App\Sorteios','prom_id','id');
    }


	public function getPermaLink()
	{

		return  url('/promocoes/'.$this->attributes['slug']);

	}

	public function getTotalPremiacao(){

		$valor = 0;
		
		$premios = $this->premios()->get();

		if(!empty($premios)):
			foreach($premios as $premio):
				$valor += ($premio->quantidade * $premio->valor);
			endforeach;
		endif;

		return $valor;
	}


	public function getUrlGanhadores(){

		if($this->attributes['url_ganhadores']):

			return $this->attributes['url_ganhadores'];

		else:

			return $this->attributes['url_hotsite'];
		
		endif;

	}




   // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($promocao) { // before delete() method call this
             $promocao->premios()->delete();
             // do the rest of the cleanup...
        });
    }

}
