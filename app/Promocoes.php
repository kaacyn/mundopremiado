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

	public function getPermaLink()
	{

		return  url('/promocoes/'.$this->attributes['slug']);

	}
}
