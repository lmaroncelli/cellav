<?php

namespace App\Http\Controllers\Admin;


use App\Caratteristica;
use App\Categoria;
use App\Http\Requests;
use App\Prodotto;
use App\Produttore;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProdottiController extends AdminController
{

    /**
   * [getDates You may customize which fields are automatically mutated to instances of Carbon by overriding the getDates method]
   */
  public function getDates() 
    {
    return ['scadenza'];
    }
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
        $categorie_associate = [];
        $caratteristiche_associate = [];
        return view('admin.prodotti.form', compact('prodotto','produttori','caratteristiche','categorie','caratteristiche_associate', 'categorie_associate')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //dd($request->all());
        $prodotto = Prodotto::create($request->all());

        $caratteristiche = $request->get('caratteristiche');
        $prodotto->caratteristiche()->attach($caratteristiche);

        $categorie = $request->get('categorie');
        $prodotto->categorie()->attach($categorie);

        return redirect()->route('prodotti.index')->with('status', 'Prodotto creato correttamente!');
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
        $prodotto = Prodotto::find($id);
        $produttori = Produttore::pluck('nome', 'id');
        $caratteristiche = Caratteristica::pluck('nome', 'id');
        $categorie = Categoria::pluck('nome', 'id');
        $caratteristiche_associate = $prodotto->caratteristiche()->pluck('id')->toArray();
        $categorie_associate = $prodotto->categorie()->pluck('id')->toArray();
        return view('admin.prodotti.form', compact('prodotto','produttori','caratteristiche','categorie','caratteristiche_associate','categorie_associate')); 
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
        $prodotto = Prodotto::find($id);
        $prodotto->fill($request->except('img_main'));

        if ( !is_null($request->file('img_main')) )
          {
          $image = $request->file('img_main');
          $imageName = time().$image->getClientOriginalName();

          $path_img_prodotto = $image->storeAs('prodotti',$imageName); 

          // open an image file
          $img = Image::make(storage_path('app/'.$path_img_prodotto));

          // resize image instance
         // resize the image to a height of 200 and constrain aspect ratio (auto width)
         $img->resize(null, 50, function ($constraint) {
             $constraint->aspectRatio();
         });

          // // save file with medium quality
          $img->save(storage_path('app_thumb/prodotti/' .$imageName), 60);


          $prodotto->img_main = $path_img_prodotto;
          } 

        $caratteristiche = $request->get('caratteristiche');

        if(!is_null($caratteristiche))
          {
          $prodotto->caratteristiche()->sync($caratteristiche);
          }

        $categorie = $request->get('categorie');

        $prodotto->categorie()->sync($categorie);

        $prodotto->save();

        return redirect()->route('prodotti.index')->with('status', 'Prodotto modificato correttamente!');
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
