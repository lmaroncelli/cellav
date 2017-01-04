<?php

namespace App;

use App\ImmagineSlide;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	protected $table = 'tblSlide';

	protected $fillable = [
	        'titolo',
			];


	public function immagini()
		{
			return $this->hasMany('App\ImmagineSlide','slide_id','id');
		}


	public function widget()
		{
			return $this->belongsTo('App\SlideProdottiWidget','slide_id','id');
		}


	public function scopeTitolo($query, $titolo)
	   {
	       return $query->where('titolo', $titolo);
	   }

}
