<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use App\Prodotto;
use Illuminate\Http\Request;

class SiteController extends Controller
{


	private function _createPageListing($page)
		{
			if(strpos($page->listingCaratteristiche, ",") !== false)
    		{
  			// se ci sono PIU' CARATTERISTICHE (le cerco in AND)
  			$prodotti_ids = [];
  			$count = 0;

  			foreach (explode(',',$page->listingCaratteristiche) as $caratteristica) 
  				{

					$count++;

  				// Prodotto con la caratteristica $caratteristica
					$prodotti = Prodotto::visibile()
												/*->valido()*/
												->listingCategorie($page->listingCategorie)
												->listingCaratteristiche($caratteristica)
												->get();
  				
					foreach ($prodotti as $prodotto) 
						{
							
							!isset($prodotti_ids[$prodotto->id]) ? $prodotti_ids[$prodotto->id] = 1 : $prodotti_ids[$prodotto->id]++; 	
						}


  				} // loop caratteristiche
  			
  			$final_prodotti_ids = [];
  			
  			// prendo gli id dei prodotti che hanno ALMENO TUTTE LE CARATTERISTICHE CERCATE
  			foreach ($prodotti_ids as $id => $c) 
  				{
  				if($c==$count) $final_prodotti_ids[]=$id; 
  				}

  			$prodotti = Prodotto::with(['caratteristiche'])->whereIn('id',array_unique($final_prodotti_ids))->get();

  			}
  		else 
  			{
  			// se c'è SOLO 1 CARATTERISTICA
				$prodotti = Prodotto::with(['caratteristiche'])
											->visibile()
											/*->valido()*/
											->listingCategorie($page->listingCategorie)
											->listingCaratteristiche($page->listingCaratteristiche)
											->get();
  			
  			}
  		//dd($prodotti);
			return $prodotti;
		}

	public function make($slug = "")
	{
		if (empty($slug)) 
			{
			echo "home";
			} 
		else 
			{
			
			$page = Page::where('uri',$slug)->first();

			if ($page->listing) 
				$prodotti = self::_createPageListing($page);
			
			return view('site',compact('page','prodotti'));
			}
				
	}

}
