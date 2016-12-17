<?php

namespace App\Http\Controllers;

use App\CategoriaRicetta;
use App\HomePage;
use App\Http\Requests;
use App\Page;
use App\Prodotto;
use App\Slide;
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


	private function _getCategorieRicette($page)	
		{

		$elem_arr = explode(',',$page->listingCategorieRicette);

		// non ci sono id
		if(!count($elem_arr))
			return null;

		$categorieRicette = CategoriaRicetta::with([

												'ricette' => function($query){
															$query->visibile();
													},
													
													])
													->whereIn('id',$elem_arr)
													->get();

		return $categorieRicette;

		}





	public function make($slug = "")
	{
		if (empty($slug)) 
			{
			$homepage = HomePage::first();

			$slide_header = Slide::with(['immagini'])->titolo('hp_slide_header')->first();
			
			$first_header_image = null;
			$header_images = [];

			foreach ($slide_header->immagini as $count => $immagine) 
				{
				if ($count == 0) 
					{
					$first_header_image =  url('images/'.$immagine->nome);
					} 
				else 
					{
					$header_images[] = url('images/'.$immagine->nome);
					}
				}

			return view('home',compact('first_header_image','header_images','homepage'));
			} 
		else 
			{

			$page = Page::where('uri',$slug)->first();
			$categorieRicette = null;

			if ($page->listing) 
				$prodotti = self::_createPageListing($page);
			
			if ($page->listingCategorieRicette)
				$categorieRicette = self::_getCategorieRicette($page);

			return view('site',compact('page','prodotti', 'categorieRicette'));
			
			}
				
	}


	public function makeCategoria($slug = "")
	{
		if (empty($slug)) 
			{
			echo "nessuna categoria associata!!";
			} 
		else 
			{

			$categoriaRicette = CategoriaRicetta::with([

					'ricette' => function($query){
								$query->visibile();
						},
						
						])
						->where('uri',$slug)->first();

			return view('site',compact('categoriaRicette'));
			
			}
				
	}

}
