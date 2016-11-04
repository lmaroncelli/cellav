<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class CarrelloController extends AdminController
{


	public function addProdotto($prodotto_id)
		{

			echo "Add Prodotto!";
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
