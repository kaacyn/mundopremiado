<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DateTime;

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


	public function contagemRegressiva(){
		$tempo = array();
		$tempo_concat = "";
		$data_inicio = new DateTime( date('Ymd') );
		$data_fim    = new DateTime( $this->attributes['data_fim'] );

		$intervalo = $data_inicio->diff( $data_fim );

		if($intervalo->y != 0):
			$tempo[] = "{$intervalo->y} ".($intervalo->y==1?"ano":"anos");
		endif;

		if($intervalo->m != 0):
			$tempo[] = "{$intervalo->m} ".($intervalo->m==1?"mês":"meses");
		endif;

		if($intervalo->d != 0):	
			$tempo[] = "{$intervalo->d} ".($intervalo->d==1?"dia":"dias");
		endif;

		 $x=0;
		 if(!empty($tempo) and $data_inicio <  $data_fim):
			foreach($tempo as $tem): $x++;

				if(count($tempo)-1 == $x):
					$tempo_concat .= $tem." e ";
				elseif(count($tempo) == $x):
					$tempo_concat .= $tem;
				else:
					$tempo_concat .= $tem.", ";
				endif;

			endforeach;

			return "Tempo restante: <strong>". $tempo_concat.",</strong> ";

		elseif($data_inicio ==  $data_fim):
			return "<strong>Essa promoção encerra hoje,</strong> ";
		else:

			return "<strong>Promoção encerrada,</strong> ";

		endif;
	}

	public function isEncerrada(){
		
		$tempo 			= array();
		$tempo_concat 	= "";
		$data_inicio 	= new DateTime( date('Ymd') );
		$data_fim    	= new DateTime( $this->attributes['data_fim'] );

		if($data_inicio >  $data_fim):
		
			return false;

		endif;

		return true;

	}

}
