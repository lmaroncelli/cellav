<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{

	protected $table = 'tblProdotti';

    protected $fillable = [
        'nome',
				'codice',
				'disponibile',
				'scadenza',
				'prezzo',
				'prezzo_offerta',
				'novita',
				'offerta',
				'visibile',
				'produttore_id',
		];


	/**
	 * [Un prodotto è di un produttore]
	 * 
	 * @return [type] [\Illuminate\Database\Eloquent\Relations\BelongsTo]
	 */
	public function produttore()
		{
			$this->belongsTo('App\Produttore','produttore_id','id');
		}



	public function caratteristiche()
		{
			$this->belongsToMany('App\Caratteristica','tblCaratteristicheProdotti','caratteristica_id','prodotto_id');
		}


	public function categorie()
		{
			$this->belongsToMany('App\Categoria','tblCategorieProdotti','categoria_id','prodotto_id');
		}




}
