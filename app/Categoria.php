<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

	protected $table = 'tblCategorie';

  protected $fillable = [
        'nome',
		];

	public function prodotti()
	{
		$this->belongsToMany('App\Prodotto','tblCategorieProdotti','prodotto_id','categoria_id');
	}


}
