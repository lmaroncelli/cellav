<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Page;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PagesController extends AdminController
{

    private function _manage_content_summernote($content)
    {
      $dom = new \DomDocument();
      $dom->encoding='utf-8';
      
      libxml_use_internal_errors(true);
      $dom->loadHtml(utf8_decode($content), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
      $images = $dom->getElementsByTagName('img');
     // foreach <img> in the submited content
      foreach($images as $img){
          $src = $img->getAttribute('src');
          
          // if the img source is 'data-url'
          if(preg_match('/data:image/', $src)){                
              // get the mimetype
              preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
              $mimetype = $groups['mime'];                
              // Generating a random filename
              $filename = uniqid();
              $filepath = "summernoteimages/$filename.$mimetype";    
              // @see http://image.intervention.io/api/
              $image = Image::make($src)
                // resize if required
                /* ->resize(300, 200) */
                ->encode($mimetype, 100)  // encode file to the specified mimetype
                ->save(public_path($filepath));                
              $new_src = asset($filepath);
              $img->removeAttribute('src');
              $img->setAttribute('src', $new_src);
          } // <!--endif
      } // <!-- endfor
      return $dom->saveHTML($dom->documentElement);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        Page::create($request->all());
        return redirect()->route('pages.index')->with('status', 'Pagina creata correttamente!');

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
        $page = Page::find($id);
        return view('admin.pages.form', compact('page'));

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
        $content = self::_manage_content_summernote($request->get('content'));

        $page = Page::find($id);
        $page->fill(['content' => $content]);
        $page->fill($request->except('content'))->save();

        return redirect()->route('pages.index')->with('status', 'Pagina modificata correttamente!');

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


    public function createUri(Request $request)
    {

        $value = $request->input("value");

        echo str_slug($value,'-');

    }
}
