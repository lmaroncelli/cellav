<?php

namespace App;
;
use Illuminate\Database\Eloquent\Model;

class SlideProdottoWidget extends Model
{
	protected $table = 'tblSlideProdottiWidget';

	protected $fillable = [
	      'id',
				'nome',
				'slide_id',
				'titolo',
				'descrizione',
				'url_pagina',
				'url_video',
			];


	public function slide()
		{
			return $this->hasOne('App\Slide','slide_id','id');
		}

}
