<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ImmagineSlide;
use App\Slide;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    function __construct()
    {
        $this->slide_header = Slide::with(['immagini'])->titolo('hp_slide_header')->first();
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
    return view('admin.pagine.homepage.form', compact('slide_header'));
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
        dd($request->all());
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
