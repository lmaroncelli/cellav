<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ImmagineSlide;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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

      // open an image file
      $img = Image::make(storage_path('app/'.$path));

      // resize image instance
      $img->resize(1170);

      // save image in desired format
      $img->save();

      $immagineSlide = ImmagineSlide::create(['slide_id' => $id ,'nome' => $path]);

      return response()->json(['success'=>$imageName]);
    }


    /*
    post chiamato dal caricamento di ogni immagine tramite Dropzone
     */
    public function uploadSlide(Request $request)
    {    
        $slider_id = $request->get('slide_id');

        $folder = 'homepage/slide';

        return $this->_uploadSlide($request, $slider_id, $folder);
    }

    
    /* POST chiamato per modificare le descrizioni delle immagine slideheader */
    public function modifySlide(Request $request)
      {
      $slide_id = $request->get('slide_id');
      $slide = Slide::with(['immagini'])->find($slide_id);

      foreach ($slide->immagini as $imageSlide) 
        {
        if ($request->get('descrizione_'.$imageSlide->id) != '') 
          {
          $imageSlide->descrizione = $request->get('descrizione_'.$imageSlide->id);
          $imageSlide->save();
          }
        }
      return redirect()->route('slide.edit',$slide_id)->with('status', 'Slide aggiornata correttamente!');
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
    //dd($request->all());
    $slide = Slide::create($request->all());

    return redirect()->route('slide.edit',$slide->id)->with('status', 'Slide creata correttamente!');
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
    $slide = Slide::find($id);
    return view('admin.slide.form', compact('slide')); 
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
    $slide = Slide::find($id);
    $slide->fill($request->all())->save();
    
    return redirect()->route('slide.edit',$slide->id)->with('status', 'Slide modificata correttamente!');

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
