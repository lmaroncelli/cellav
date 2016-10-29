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
		'uri',
	];


	/**
	 * [Un prodotto è di un produttore]
	 * 
	 * @return [type] [\Illuminate\Database\Eloquent\Relations\BelongsTo]
	 */
	public function produttore()
		{
			return $this->belongsTo('App\Produttore','produttore_id','id');
		}



	public function caratteristiche()
		{
			return $this->belongsToMany('App\Caratteristica','tblCaratteristicheProdotti','prodotto_id', 'caratteristica_id');
		}


	public function categorie()
		{
			return $this->belongsToMany('App\Categoria','tblCategorieProdotti','prodotto_id','categoria_id');
		}



	/*
	Defining Mutators
	 */
	
	// I prezzo se sono stringhe vuote devono diventare 0

/*	
public function setPrezzoOffertaAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['prezzo_offerta'] = 0.00;
    }

public function setPrezzoAttribute($value)
    {
    		if ($value == '')
        	$this->attributes['prezzo'] = 0.00;
    }
 */

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



   public function scopeVisibile($query)
   	{
   		return $query->where('visibile', 1);	
   	}


   	/**
   	 * [scopeListingCategorie PIU' categorie sono cercate in OR (se appartiene a pane e pizza oppure  dolci)]
   	 * @param  [type] $query     [description]
   	 * @param  [type] $categorie [description]
   	 * @return [type]            [description]
   	 */
   public function scopeListingCategorie($query, $categorie)
   	{
      	if(!$categorie)
       		return $query;

       	// trovo gli id dei prodotti che che hanno ALMENO tutte le categorie elencate in $categorie
    		// e poi faccio una query whereIn
    		
    		
    		if(strpos($categorie, ",") !== false)
    			{
    			// se ci sono PIU' CATEGORIE
    			// 
					return $query->whereHas('categorie', function($q) use ($categorie){
				        $q->whereIn( 'categoria_id', explode(',',$categorie) );
				    });
    			}
    		else 
    			{
    			// se c'è SOLO 1 CATEGORIA

    			return $query->whereHas('categorie', function($q) use ($categorie){
    		        $q->where('categoria_id', $categorie);
    		    });

    			}
       
    }

    /**
     * [scopeListingCaratteristiche description]
     * @param  [type] $query           [description]
     * @param  [type] $caratteristiche [description]
     * @return [type]                  [description]
     */
    public function scopeListingCaratteristiche($query, $caratteristiche)
   	{
      	if(!$caratteristiche)
       		return $query;

       	// trovo gli id dei prodotti che che hanno ALMENO tutte le caratteristiche elencate in $caratteristiche
    		// e poi faccio una query whereIn
    		
    		
    		if(strpos($caratteristiche, ",") !== false)
    			{
    			// se ci sono PIU' CARATTERISTICHE le devo prendere im AN
    			// se seleziono 3 caratteristiche (senza uovo, senza lattosio, senza soia)
    			// voglio i prodotti CHE ABBIANO TUTTE QUELLE CARATTERISTICHE !!! 
					
					return $query->whereHas('caratteristiche', function($q) use ($caratteristiche){
				        foreach (explode(',',$caratteristiche) as $caratteristica) 
				        	{
				        	$q->where('caratteristica_id', $caratteristica);
				        	}
				    });

    			}
    		else 
    			{
    			// se c'è SOLO 1 CARATTERISTICA

    			return $query->whereHas('caratteristiche', function($q) use ($caratteristiche){
    		        $q->where('caratteristica_id', $caratteristiche);
    		    });

    			}
       
    }





}
