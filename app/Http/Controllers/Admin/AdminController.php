<?php

namespace App\Http\Controllers\admin;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;





class AdminController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function __construct()
    {
    	$this->middleware('auth');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    		if (Auth::user()->ruolo == 'admin') {
        	return view('home');
    		} else {
    			return redirect('/');
    		}
    		
    }
}
