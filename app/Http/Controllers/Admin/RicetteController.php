<?php

namespace App\Http\Controllers\Admin;

use App\CategoriaRicetta;
use App\Ricetta;
use Illuminate\Http\Request;

class RicetteController extends AdminController
{

    private function _uploadFile(Request $request)
        {
            $file = $request->file('foto');

            $ext = $file->clientExtension();

            return $file->storeAs('ricette','foto_ricetta_'.$request->get('uri').'.'.$ext);
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $ricette = Ricetta::all();
    
    return view('admin.ricette.index', compact('ricette'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ricetta $ricetta)
    {
        
        $categorie = CategoriaRicetta::orderBy('nome')->pluck('nome', 'id');
        
        return view('admin.ricette.form', compact('ricetta','categorie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $ricetta = Ricetta::create($request->all());

    $ricetta->foto = $this->_uploadFile($request);

    $ricetta->save();    

    return redirect()->route('ricette.index')->with('status', 'Ricetta creata correttamente!');
    
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
    $ricetta = Ricetta::find($id);
    $categorie = CategoriaRicetta::orderBy('nome')->pluck('nome', 'id');

    return view('admin.ricette.form', compact('ricetta','categorie')); 
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

    $ricetta = Ricetta::find($id);
    $ricetta->fill($request->all());
    $ricetta->foto = $this->_uploadFile($request);

    $ricetta->save();   

    return redirect()->route('ricette.index')->with('status', 'Ricetta modificata correttamente!');
    
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
