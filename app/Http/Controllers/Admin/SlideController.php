<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slide;
use App\ImmagineSlide;


class SlideController extends Controller
{


    /**
     * [_uploadSlide fa l'upload delle immagini con dropzone di tutte le slide della home - header, freschi e confezionati; per ognuna cambia solo l'id della slide e la folder dove salvare le immagini]
     * @param  integer $id     [id della slide]
     * @param  string  $folder [folder dove salvare le immagini]
     * @return [type]          [description]
     */
    private function _uploadSlide(Request $request, $id = 0, $folder = 'homepage/slide')
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
    public function uploadSlide(Request $request)
    {    
        $slide_header = $this->slide_header;

        $slider_id = $slide_header->id;

        $folder = 'homepage/slide';

        return $this->_uploadSlide($request, $slider_id, $folder);
    }

    
    /* POST chiamato per modificare le descrizioni delle immagine slideheader */
    public function modifySlide(Request $request)
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $slide = Slide::all();
    
    return view('admin.slide.index', compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Slide $slide)
    {
    return view('admin.slide.form', compact('slide')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
