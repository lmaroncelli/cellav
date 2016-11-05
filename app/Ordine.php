<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordine extends Model
{
	protected $table = 'tblOrdini';

	protected $fillable = [
	        'user_id','totale','indirizzo',
			];


	public function prodotti()
		{
			return $this->hasMany('App\ProdottoOrdine','ordine_id','id');
		}


	public function cliente()
		{
			return $this->belongsTo('App\User','user_id','id');
		}

}
