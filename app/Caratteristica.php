<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caratteristica extends Model
{

	protected $table = 'tblCaratteristiche';

  protected $fillable = [
        'nome',
		];


	public function prodotti()
	{
		$this->belongsToMany('App\Prodotto','tblCaratteristicheProdotti','prodotto_id','caratteristica_id');
	}
	


}
