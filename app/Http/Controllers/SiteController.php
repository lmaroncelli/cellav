<?php

namespace App\Http\Controllers;

use App\CategoriaRicetta;
use App\HomePage;
use App\Http\Requests;
use App\Page;
use App\Prodotto;
use App\Slide;
use App\SlideCategorieProdotti;
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
			$slide_freschi = Slide::with(['immagini'])->where('id',$homepage->prodotti_freschi_slide_id)->first();
			$slide_confezionati = Slide::with(['immagini'])->where('id',$homepage->prodotti_confezionati_slide_id)->first();
			
			$first_header_image = null;
			$header_images = [];

			foreach ($slide_header->immagini as $count => $immagine) 
				{
				if ($count == 0) 
					{
					$first_header_image =  url('images/'.$immagine->nome);
					$first_desc_image =  $immagine->descrizione;
					} 
				else 
					{
					$header_images[] = url('images/'.$immagine->nome);
					$desc_images[] = $immagine->descrizione;
					}
				}

			///////////////////////////////////////////////////////////////
			// MOMENTANEAMENTE SELEZIONO SOLO I PRODOTTI CON LE IMMAGINI //
			///////////////////////////////////////////////////////////////
			$prodotti = Prodotto::where('img_main' ,'!=','')->get();

			return view('home',compact('first_header_image','header_images','first_desc_image','desc_images', 'slide_freschi', 'slide_confezionati', 'homepage','prodotti'));
			} 
		else 
			{

			$page = Page::where('uri',$slug)->first();

			if( !is_null($page->headerSlide) )
				{
				$slide_header = Slide::with(['immagini'])->where('id',$page->headerSlide)->first();	
				}
			else
				{
				$slide_header = null;
				}


			if( !is_null($page->categorie_prodotti_slide_id) )
				{
				$slide_categorie_prodotti = SlideCategorieProdotti::with(['immagini'])->where('id',$page->categorie_prodotti_slide_id)->first();	
				}
			else
				{
				$slide_categorie_prodotti = null;
				}
			
			$widgetProdottiConfezionati = $page->widgetProdottiConfezionati;
			$widgetProdottiFreschi = $page->widgetProdottiFreschi;
			$widgetThreeColumns = $page->widgetThreeColumns;
		


			$categorieRicette = null;

			if ($page->listing) 
				$prodotti = self::_createPageListing($page);
			
			if ($page->listingCategorieRicette)
				$categorieRicette = self::_getCategorieRicette($page);

			return view('site',compact('page','prodotti', 'categorieRicette','slide_header', 'slide_categorie_prodotti','widgetProdottiConfezionati','widgetProdottiFreschi','widgetThreeColumns'));
			
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
