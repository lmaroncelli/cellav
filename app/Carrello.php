<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrello extends Model
{
	protected $table = 'tblCarrelli';

	protected $fillable = [
	        'user_id',
			];


	public function prodotti()
		{
			return $this->hasMany('App\ProdottoCarrello','carrello_id','id');
		}


	public function utente()
		{
			return $this->belongsTo('App\User','user_id','id');
		}

}
