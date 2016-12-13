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
    
    <form  method="POST" action="{{ route('homepage.save') }}" enctype="multipart/form-data">
    {{ csrf_field() }}    
    <div class="row">

      <h2>Negozi</h2></div>
     
      <div id="exTab2"> 

      <ul class="nav nav-tabs">
        <li class="active">
          <a  href="#1" data-toggle="tab">LAB</a>
        </li>
        <li><a href="#2" data-toggle="tab">CIPRO</a>
        </li>
        <li><a href="#3" data-toggle="tab">TIBURTINA</a>
        </li>
      </ul>

      <div class="tab-content ">
        <div class="tab-pane active" id="1">
          <h3>Inserisci i dati per il widget "Celiachiamo LAB"</h3>
          <p>
            <div class="form-group">
              <label for="titolo">Immagine</label>
              <input type="file" class="form-control" id="img" name="img_lab">
            </div>
            <div class="form-group">
              <label for="titolo">Descrizione</label>
              <textarea class="form-control" rows="3" name="desc_lab"></textarea>
            </div>
          </p>
        </div>
        <div class="tab-pane" id="2">
         <h3>Inserisci i dati per il widget "Celiachiamo CIPRO"</h3>
         <p>
            <div class="form-group">
              <label for="titolo">Immagine</label>
              <input type="file" class="form-control" id="img" name="img_cipro">
            </div>
            <div class="form-group">
              <label for="titolo">Descrizione</label>
              <textarea class="form-control" rows="3" name="desc_cipro"></textarea>
            </div>
          </p>
        </div>
        <div class="tab-pane" id="3">
          <h3>Inserisci i dati per il widget "Celiachiamo TIBURTINA"</h3>
          <p>
             <div class="form-group">
               <label for="titolo">Immagine</label>
               <input type="file" class="form-control" id="img" name="img_tiburtina">
             </div>
             <div class="form-group">
               <label for="titolo">Descrizione</label>
               <textarea class="form-control" rows="3" name="desc_tiburtina"></textarea>
             </div>
           </p>
        </div>
      </div>
     
  </div> {{-- end row --}}
    
  <button type="submit" class="btn btn-primary">Modifica</button>

  </form>



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
