<?php

namespace App\Http\Controllers\Admin;

use App\HomePage;
use App\Http\Controllers\Controller;
use App\ImmagineSlide;
use App\Slide;
use App\SlideProdottiWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SlideProdottiWidgetController extends Controller
{

    function __construct()
      {   
          $homepage = HomePage::first();
          
          $this->homepage = $homepage;

          $this->slide_header = Slide::with(['immagini'])->titolo('hp_slide_header')->first();

          $this->slide_freschi = Slide::with(['immagini'])->titolo('hp_slide_freschi')->first();

          $this->slide_confezionati = Slide::with(['immagini'])->titolo('hp_slide_confezionati')->first();

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $widgets = SlideProdottiWidget::all();

        return view('admin.widget.slide-prodotti.index', compact('widgets'));
      }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SlideProdottiWidget $widget)
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



    /**
     * [_uploadSlide fa l'upload delle immagini con dropzone di tutte le slide della home - header, freschi e confezionati; per ognuna cambia solo l'id della slide e la folder dove salvare le immagini]
     * @param  integer $id     [id della slide]
     * @param  string  $folder [folder dove salvare le immagini]
     * @return [type]          [description]
     */
    private function _uploadSlide(Request $request, $id = 0, $folder = 'homepage/slideProdotti')
    {
      $image = $request->file('file');

      $imageName = time().$image->getClientOriginalName();
      
      $path = $image->storeAs($folder,$imageName);

      $immagineSlide = ImmagineSlide::create(['slide_id' => $id ,'nome' => $path]);


      return response()->json(['success'=>$imageName]);
    }



    
    /*
    post chiamato dal caricamento di ogni immagine tramite Dropzone
     */
    public function uploadSlideHeader(Request $request)
    {    
        $slide_header = $this->slide_header;

        $slider_id = $slide_header->id;

        $folder = 'homepage/slideHeader';

        return $this->_uploadSlide($request, $slider_id, $folder);
    }




    
    public function uploadSlideProdttiFreschi(Request $request)
    {    
        $slide_freschi = $this->slide_freschi;

        $slider_id = $slide_freschi->id;

        return $this->_uploadSlide($request, $slider_id);
    }

    public function uploadSlideProdttiConfezionati(Request $request)
    {    
        $slide_confezionati = $this->slide_confezionati;

        $slider_id = $slide_confezionati->id;

        return $this->_uploadSlide($request, $slider_id);
    }




    /* POST chiamato per modificare le descrizioni delle immagine slideheader */
    public function modifySlideHeader(Request $request)
      {
      foreach ($this->slide_header->immagini as $imageSlide) 
        {
        if ($request->get('descrizione_'.$imageSlide->id) != '') 
          {
          $imageSlide->descrizione = $request->get('descrizione_'.$imageSlide->id);
          $imageSlide->save();
          }
        }
      return redirect()->route('homepage.edit')->with('status', 'Homepage aggiornata correttamente!');
      }



    public function deleteSliderImageAjax(Request $request)
      {
        $id = $request->get('id');
        $slide = ImmagineSlide::find($id);
        $foto_vecchia = $slide->nome;
        if(!is_null($foto_vecchia) && $foto_vecchia != '')
          {
        Storage::delete([$foto_vecchia]);
          }
        ImmagineSlide::destroy($id);

        echo "ok";
      }

    
    public function deleteNegozioImageAjax(Request $request)
      {
        $colname = $request->get('colname');

        $homepage = $this->homepage;

        if(!is_null($homepage->$colname) && $homepage->$colname != '')
          {
        Storage::delete([$homepage->$colname]);
          }
       
        $homepage->$colname = null;

        $homepage->save();        

        echo "ok";
      }

}
