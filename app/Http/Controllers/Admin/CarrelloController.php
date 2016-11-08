<?php

namespace App\Http\Controllers\Admin;

use App\Carrello;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Prodotto;
use App\ProdottoCarrello;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrelloController extends AdminController
{


	public function addProdotto($prodotto_id)
		{
		$carrello = Carrello::where('user_id',Auth::user()->id)->first();
        $prodotto = Prodotto::findOrFail($prodotto_id);

			
    if(!$carrello)
    	{
     	$carrello =  new Carrello();
     	$carrello->user_id=Auth::user()->id;
     	$carrello->save();
    	}

    $prodottoCarrello  = new ProdottoCarrello();
    $prodottoCarrello->prodotto_id=$prodotto_id;
    $prodottoCarrello->carrello_id= $carrello->id;

    if (!is_null($prodotto->prezzo_offerta) && $prodotto->prezzo_offerta > 0) {
        $prodottoCarrello->prezzo = $prodotto->prezzo_offerta;
    } else {
        $prodottoCarrello->prezzo = $prodotto->prezzo;
    }
    $prodottoCarrello->save();

    return redirect('/carrello');
			
			
		}


	public function showCarrello(){
        $carrello = Carrello::where('user_id',Auth::user()->id)->first();
 
        if(!$carrello){
            $carrello =  new Carrello();
            $carrello->user_id=Auth::user()->id;
            $carrello->save();
        }
 
        $prodottiCarrello = $carrello->prodotti;
        $total=0;
        foreach($prodottiCarrello as $prodottoCarrello){

        		$prodotto = $prodottoCarrello->prodotto;
        	
        		if (!is_null($prodotto->prezzo_offerta) && $prodotto->prezzo_offerta > 0) {
        			$total+=$prodotto->prezzo_offerta;
        		} else {
        			$total+=$prodotto->prezzo;
        		}
        	
        }
 
        return view('carrello.viewCarrello',['prodottiCarrello'=>$prodottiCarrello,'total'=>$total]);
    }
 
    public function removeProdotto($prodotto_id){
 
        ProdottoCarrello::destroy($prodotto_id);
        return redirect('/carrello');
    }






	public function show($id)
		{
			$carrello = Carrello::findOrFail($id);
			
			if(!Gate::denies('access',$carrello))
				abort('403','cannot access !!');

			/*if(!Gate::denies('visualizza-carrello',$carrello))
				abort('403','cannot access !!');*/
		

		}

}
