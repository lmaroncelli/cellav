<?php

namespace App\Http\Controllers\Admin;

use App\HomePage;
use App\Http\Controllers\Controller;
use App\ImmagineSlide;
use App\Slide;
use App\SlideProdottoWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SlideProdottiWidgetController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $widgets = SlideProdottoWidget::all();

        return view('admin.widget.slide-prodotti.index', compact('widgets'));
      }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SlideProdottoWidget $widget)
    {
        
        $slideProdotti = Slide::pluck('titolo', 'id');

        return view('admin.widget.slide-prodotti.form', compact('widget','slideProdotti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
      {
      return view('admin.widget.slide-prodotti.form');
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
        $widget = SlideProdottoWidget::create($request->all());

        return redirect()->route('slide-prodotti-widget.index')->with('status', 'Widget creato correttamente!');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      /////////////////////
      // upload MAGLIANA //
      /////////////////////

      $data = [];

      foreach (array('magliana','cipro','tiburtina') as $negozio) 
        {

        if (!is_null($request->file('img_'.$negozio)))
          {
          $image = $request->file('img_'.$negozio);
          $imageName = time().$image->getClientOriginalName();

          $path_img_negozio = $image->storeAs('homepage/negozi',$imageName); 
          $data['img_'.$negozio] = $path_img_negozio;
          } 

        $desc_negozio = $request->get('desc_'.$negozio);
        $data['desc_'.$negozio] = $desc_negozio;
        
        }

      DB::table('tblHomePages')
          ->where('id', 1)
          ->update($data);

      return redirect()->route('pannello')->with('status', 'Homepage aggiornata correttamente!');
    }


}
