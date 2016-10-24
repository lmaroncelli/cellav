<?php

namespace App;

use Carbon\Carbon;
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
		'peso',
		'descrizione',
		'scheda',
		'ingredienti',
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



	/*
	Defining Mutators
	 */
	
	// I prezzo se sono stringhe vuote devono diventare 0
	public function setPrezzoOffertaAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['prezzo_offerta'] = 0;
    }

  public function setPrezzoAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['prezzo'] = 0;
    }

	public function setScadenzaAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['scadenza'] = Carbon::now();
    } 

  public function setDisponibileAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['disponibile'] = -1;
    }	



}
