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
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class CarrelloController extends AdminController
{


	public function addProdotto($prodotto_id)
		{

		$carrello = Carrello::where('user_id',Auth::user()->id)->first();
        $prodotto = Prodotto::findOrFail($prodotto_id);

        $count = ProdottoCarrello::where('prodotto_id', $prodotto_id)->where('carrello_id', $carrello->id)->count();

        if($count)
            {
            return Redirect::route('carrello.show')->with('status','Il prodotto è già presente nel carrello!');
            }

			
        if(!$carrello)
        	{
         	$carrello =  new Carrello();
         	$carrello->user_id=Auth::user()->id;
         	$carrello->save();
        	}

        $prodottoCarrello  = new ProdottoCarrello();
        $prodottoCarrello->prodotto_id=$prodotto_id;
        $prodottoCarrello->carrello_id= $carrello->id;
        $prodottoCarrello->prezzo = $prodotto->prezzo;
        
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
        
        $total=$carrello->getTotale();
 
        return view('carrello.viewCarrello',['carrello_id' => $carrello->id ,'prodottiCarrello'=>$prodottiCarrello,'total'=>$total]);
    }
 
    public function removeProdotto($prodotto_id){
 
        ProdottoCarrello::destroy($prodotto_id);
        return redirect('/carrello');
    }




    public function updateCarrelloQtyAjax(Request $request)
        {
            
            $prodottoCarrelloId = $request->get('prodottoCarrelloId');
            $qty = $request->get('qty');

            ProdottoCarrello::where('id', $prodottoCarrelloId)->update(['numero' => $qty]);

            echo "ok";

        }



    public function getCheckout()
        {
        $carrello = Carrello::where('user_id',Auth::user()->id)->first();
 
        if(!$carrello)
            {
             return Redirect::route('carrello.show')->with('status','Il carrello è vuoto!');
            }
        $prodottiCarrello = $carrello->prodotti;
        
        $total=$carrello->getTotale();
        
        return view('carrello.viewCheckout',['prodottiCarrello'=>$prodottiCarrello,'total'=>$total]);


        }


    public function postCheckout(Request $request)
    {
        //dd($request->all());
        /*
        array:4 [▼
          "_token" => "sn7eMN4iLvJjxwEU0bDi679Qu9Utrus7kE63Fn37"
          "stripeToken" => "tok_19E3gFL8VvGCsPcJuJYu4Acx"
          "stripeTokenType" => "card"
          "stripeEmail" => "lmaroncelli@gmail.com"
        ]
         */
        
        
// TUTTE QUESTE OPERAZIONI ANDREBBERO FATTE DOPO LA REGISTRAZIONE:
// creo subito un customer Stripe la prima volta e memorizzo il customer->id associato all'utente
// successivamente se l'utente ha un customer id posso caricare l'id e fare direttamente il charge 



        Stripe::setApiKey(config('services.stripe.secret'));


        ///////////////////////////////////////////////////////////////////
        // ATTENZIONE QUI DEVO RICARICARE I PRODTTI PER RIFARE IL TOTALE //
        ///////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////
        // NON LO PASSO VIA FORM HIDDEN, PUO' ESSERE MANIPOLATO //
        //////////////////////////////////////////////////////////

        $carrello = Carrello::where('user_id',Auth::user()->id)->first();
        
        if(!$carrello)
            {
             return Redirect::route('checkout')->with('error','Il carrello dell\'utente  non esiste!');
            }

        $total=$carrello->getTotaleForStripe();

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // nel reale salvo questo customer->id nel datase in modo da non fare sempre reinserire i dati della carta di credito 
        // se ho il customer->id posso fare il charge !!!//ATTENZIONE QUI DEVO RICARICARE I PRODTTI PER RIFARE IL TOTALE //

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


       /* try {
            $customer = Customer::create(array(
                 'email' =>  $request->get('stripeEmail'),
                 'source'  => $request->get('stripeToken')
             ));
            
        } catch (\Exception $e) {
            return Redirect::route('checkout')->with('error',$e->getMessage());
        }*/



        try {
            
            $charge = Charge::create(array(
                  /*'customer' => $customer->id,*/
                  'amount'   => $total,
                  'currency' => 'eur',
                    'source'  => $request->get('stripeToken'),
                  'description' => "Charge di prova"
              ));


            /////////////////////
            // CARICO L'ORDINE //
            /////////////////////
            $ordine =  new Ordine();
            $ordine->user_id=Auth::user()->id;
            $ordine->save();


            ///////////////////////////////////
            // CARICO I PRODOTTI DELL'ORDINE //
            ///////////////////////////////////
            foreach ($carrello->prodotti as $count => $prodottoCarrello) {
                $prodottoOrdine  = new ProdottoOrdine();
                $prodottoOrdine->prodotto_id=$prodottoCarrello->prodotto_id;
                $prodottoOrdine->ordine_id= $ordine->id;
                $prodottoOrdine->prezzo = $prodottoCarrello->prezzo;
                $prodottoOrdine->numero = $prodottoCarrello->numero;
                $prodottoOrdine->save();
            }


            
            
        } catch (\Exception $e) {
            return Redirect::route('checkout')->with('error',$e->getMessage());
        }






        /////////////////////////
        // ELIMINO IL CARRELLO //
        /////////////////////////
        $carrello->delete();

        return 'ok';

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
