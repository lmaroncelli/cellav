<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use Illuminate\Http\Request;

class SiteController extends Controller
{

	public function make($slug = "")
	{
		if (empty($slug)) 
			{
			echo "home";
			} 
		else 
			{
			$page = Page::where('uri',$slug)->first();
			
			return view('site',compact('page'));
			}
				
	}

}
