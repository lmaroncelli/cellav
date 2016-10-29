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
			$prodotti = Prodotto::visibile()
										->listingCategorie($page->listingCategorie)
										->get();
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
