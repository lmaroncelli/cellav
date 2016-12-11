@extends('admin.layouts.backend')

@section('css')
	<link rel="stylesheet" href="/css/dropzone/dropzone.css">
@stop

@section('title')
	Gestisci la home page
@stop

@section('content')
    
    <h2>Slide header</h2>
    
    @if ($slide_header->immagini->count())
      <div class="row">
      <div class=container_galleria>  
      <ul class="galleria">
      @foreach ($slide_header->immagini as $immagine)
          <li><img src="{{ url('images/'.$immagine->nome) }}" width="150" height="100"></li>    
      @endforeach
      </ul>
      </div>
      </div>
    @endif
    
    <div class="row">
      <form  method="POST" action="{{ route('homepage.uploaduploadSlideHeader') }}" class="dropzone"  enctype="multipart/form-data" id="formUpload">
        {{ csrf_field() }}
        <input type="hidden" name="slide_id" value="{{$slide_header->id}}">
      </form>
      
      <div id="preview-template" style="display: block;"></div>
    </div>

    <hr>
    <hr>
  <a class="btn btn-primary" href="{{ route('gallerie.index') }}">Torna all'elenco</a>



@stop


    @section('script_head')
      <script src="/js/dropzone.js"></script>
    @stop

    @section('script')
      <script type="text/javascript">

            Dropzone.options.formUpload = {
              paramName: "file", // The name that will be used to transfer the file
              maxFilesize: 2, // MB
              acceptedFiles: ".jpeg,.jpg,.png,.gif",
              //previewTemplate: document.getElementById('preview-template').innerHTML,
              accept: function(file, done) {
                if (file.name == "xxx.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              }
            };
    </script>

    @stop
