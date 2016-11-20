<?php

namespace App;

use App\ImmagineGalleria;
use Illuminate\Database\Eloquent\Model;

class Galleria extends Model
{
	protected $table = 'tblGallerie';

	protected $fillable = [
	        'nome',
			];


	public function immagini()
		{
			return $this->hasMany('App\ImmagineGalleria','galleria_id','id');
		}

}
