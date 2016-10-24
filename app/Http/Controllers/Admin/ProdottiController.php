<?php

namespace App\Http\Controllers\Admin;


use App\Caratteristica;
use App\Categoria;
use App\Http\Requests;
use App\Prodotto;
use App\Produttore;
use Illuminate\Http\Request;

class ProdottiController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
    $prodotti = Prodotto::all();
    
    return view('admin.prodotti.index', compact('prodotti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prodotto $prodotto)
    {
        $produttori = Produttore::pluck('nome', 'id');
        $caratteristiche = Caratteristica::pluck('nome', 'id');
        $categorie = Categoria::pluck('nome', 'id');
        return view('admin.prodotti.form', compact('prodotto','produttori','caratteristiche','categorie')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'codice' => 'required',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
