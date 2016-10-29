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
  			// se ci sono PIU' CARATTERISTICHE
  			$prodotti_ids = [];
  			foreach (explode(',',$page->listingCaratteristiche) as $caratteristica) 
  				{
  				// Prodotto con la caratteristica $caratteristica
					$prodotti = Prodotto::visibile()
												->listingCategorie($page->listingCategorie)
												->listingCaratteristiche($caratteristica)
												->get();
  				
					foreach ($prodotti as $prodotto) 
						{
						
						// lo inserisco se è il primo prodotto oppure se ha anche le altre caratteristiche
						if (empty($prodotti_ids) || in_array($prodotto->id, $prodotti_ids))
							$prodotti_ids[] = $prodotto->id;
						
						}
  				} // loop caratteristiche
  			
  			dd(array_unique($prodotti_ids));

  			}
  		else 
  			{
  			// se c'è SOLO 1 CARATTERISTICA
				$prodotti = Prodotto::visibile()
											->listingCategorie($page->listingCategorie)
											->listingCaratteristiche($page->listingCaratteristiche)
											->get();
  			
  			}

			dd($prodotti);
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
			
			return view('site',compact('page'));
			}
				
	}

}
