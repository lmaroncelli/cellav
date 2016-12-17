<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ImmagineSlide;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\HomePage;

class HomePageController extends Controller
{

    function __construct()
      {
          $this->slide_header = Slide::with(['immagini'])->titolo('hp_slide_header')->first();
      }



    private function _uploadFile(Request $request)
      {
          if (is_null($request->file('img'))) 
              return null;

          $file = $request->file('img');

          $ext = $file->clientExtension();

          return $file->storeAs('ricette','foto_cat_'.$request->get('uri').'.'.$ext);            
              
      }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
      {
      $slide_header = $this->slide_header;
      $homepage = HomePage::first();
      return view('admin.pagine.homepage.form', compact('slide_header','homepage'));
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

    
    /*
    post chiamato dal caricamento di ogni immagine tramite Dropzone
     */
    public function uploadSlideHeader(Request $request)
    {    
        $slide_header = $this->slide_header;

        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        
        $path = $image->storeAs('homepage/slideHeader',$imageName);

        $immagineSlide = ImmagineSlide::create(['slide_id' => $slide_header->id ,'nome' => $path]);


        return response()->json(['success'=>$imageName]);
    }
}
