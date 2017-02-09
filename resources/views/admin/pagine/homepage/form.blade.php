@extends('admin.layouts.backend')

@section('css')
  <link rel="stylesheet" href="{{ url('css/dropzone/basic.css') }}">
	<link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
@stop

@section('title')
	Gestisci la home page
@stop

@section('content')
    
    <div class="sldeHeader">    
        <div class="row">
        <h2>Slide header</h2>
        </div>

        @if ($slide_header->immagini->count())
          <form  method="POST" action="{{ route('homepage.modifySlideHeader') }}">
          {{ csrf_field() }}
          <input type="hidden" name="slide_id" value="{{$slide_header->id}}">
          
          @foreach ($slide_header->immagini as $immagine)
          <div class="row">
          
          <div class="col-md-3">        
            <img src="{{ url('images/'.$immagine->nome) }}" width="200" height="104">
          </div>
          
          <div class="col-md-8">             
    <textarea class="form-control" rows="3" name="descrizione_{{$immagine->id}}">{{old('descrizione_'.$immagine->descrizione, isset($immagine->descrizione) ? $immagine->descrizione : null)}}</textarea>
          </div>        
            
          <div class="col-md-1">
            <button type="button" class="btn btn-default delete_image_slide" data-id="{{$immagine->id}}">
              <span class="glyphicon glyphicon-remove"></span>
            </button>
          </div>
          
          </div>
          @endforeach

          <div class="row">
            <button type="submit" class="btn btn-primary">Modifica descrizioni</button>
          </div>
          
          </form>
         @else
          <div class="row">
            <p>Nessuna immagine caricata ancora</p>
          </div>
        @endif
    </div>

    <br>
    <div class="row">
      <form  method="POST" action="{{ route('homepage.uploadSlideHeader') }}" class="dropzone"  enctype="multipart/form-data" id="formUploadSlideHeader">
        {{ csrf_field() }}
        <input type="hidden" name="slide_id" value="{{$slide_header->id}}">
      </form>
    

      <div class="dz-preview dz-file-preview"  id="preview-template-silde-header" style="display: none;">
        <div class="dz-details">
          <div class="dz-filename"><span data-dz-name></span></div>
          <div class="dz-size" data-dz-size></div>
          <img data-dz-thumbnail />
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-success-mark"><span>✔</span></div>
        <div class="dz-error-mark"><span>✘</span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
      </div>

    </div>

    <hr>
    
    <div class="row">
      <h2>Negozi</h2>
    </div>
    
  
    <div class="row">
      <div class="col-md-12">
        
    
        <form  method="POST" action="{{ route('homepage.save') }}" enctype="multipart/form-data">
        {{ csrf_field() }}    
        
        <div id="exTab2"> 

          <ul class="nav nav-tabs">
            <li class="active">
              <a  href="#1" data-toggle="tab">CELIACHIAMO LAB</a>
            </li>
            <li><a href="#2" data-toggle="tab">CELIACHIAMO SHOP</a>
            </li>
            <li><a href="#3" data-toggle="tab">CELIACHIAMO TIBURTINA</a>
            </li>
          </ul>
          
          <div class="tab-content ">
            <div class="tab-pane active" id="1">
              <h3>Inserisci i dati per "Celiachiamo LAB"</h3>
              <p>
                @if (is_null($homepage->img_magliana) || $homepage->img_magliana == '')
                  <div class="form-group">
                    <label for="titolo">Immagine</label>
                    <input type="file" class="form-control" id="img" name="img_magliana">
                  </div>
                @else
                  <img src="{{ url('images/'.$homepage->img_magliana) }}" width="100" height="50">
                  <button type="button" class="btn btn-default delete_image_negozio" data-colname="img_magliana">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                @endif

                <div class="form-group">
                  <label for="titolo">Descrizione</label>
                  <textarea class="form-control" rows="3" name="desc_magliana">{{old('desc_magliana', isset($homepage->desc_magliana) ? $homepage->desc_magliana : null)}}</textarea>
                </div>
              </p>
            </div>
            <div class="tab-pane" id="2">
             <h3>Inserisci i dati per "Celiachiamo SHOP"</h3>
             <p>
                @if (is_null($homepage->img_cipro) || $homepage->img_cipro == '')
                  <div class="form-group">
                    <label for="titolo">Immagine</label>
                    <input type="file" class="form-control" id="img" name="img_cipro">
                  </div>
                @else
                  <img src="{{ url('images/'.$homepage->img_cipro) }}" width="100" height="50">
                  <button type="button" class="btn btn-default delete_image_negozio" data-colname="img_cipro">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                @endif
                <div class="form-group">
                  <label for="titolo">Descrizione</label>
                  <textarea class="form-control" rows="3" name="desc_cipro">{{old('desc_cipro', isset($homepage->desc_cipro) ? $homepage->desc_cipro : null)}}</textarea>
                </div>
              </p>
            </div>
            <div class="tab-pane" id="3">
              <h3>Inserisci i dati per "Celiachiamo TIBURTINA"</h3>
              <p>
                @if (is_null($homepage->img_tiburtina) || $homepage->img_tiburtina == '')
                 <div class="form-group">
                   <label for="titolo">Immagine</label>
                   <input type="file" class="form-control" id="img" name="img_tiburtina">
                 </div>
                @else
                  <img src="{{ url('images/'.$homepage->img_tiburtina) }}" width="100" height="50">
                  <button type="button" class="btn btn-default delete_image_negozio" data-colname="img_tiburtina">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                @endif
                 <div class="form-group">
                   <label for="titolo">Descrizione</label>
                   <textarea class="form-control" rows="3" name="desc_tiburtina">{{old('desc_tiburtina', isset($homepage->desc_tiburtina) ? $homepage->desc_tiburtina : null)}}</textarea>
                 </div>
               </p>
            </div>
          </div>
         
      </div> {{-- end exTab2 --}}
        
      <button type="submit" class="btn btn-primary">Modifica negozi</button>

      </form>

    </div>
  </div>
  
  <hr>
  

  {{-- PRODOTTI FRESCHI SLIDE --}}
  <div class="sldeProdotti">

    <div class="row">
      <h2>Prodotti freschi</h2>
    </div>
      
    @if ($slide_freschi->immagini->count())
      @foreach ($slide_freschi->immagini as $immagine)
        <div class="row">
            <div class="col-md-3"> 
              <img src="{{ url('images/'.$immagine->nome) }}" width="125" height="100">
            </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-default delete_image_slide" data-id="{{$immagine->id}}">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
            </div>
          </div>    
        @endforeach
      @else
        <p>Nessuna immagine caricata ancora</p>
      @endif

  </div>
  
  <div class="row margin">
    <div class="col-md-12"> 
      <form  method="POST" action="{{ route('homepage.uploadSlideProdttiFreschi') }}" class="dropzone"  enctype="multipart/form-data" id="formUploadSlideProdttiFreschi">
        {{ csrf_field() }}
        <input type="hidden" name="slide_id" value="{{$slide_freschi->id}}">
      </form>
    </div>
  </div>

  <div class="row margin">
    <div class="col-md-12">
      <div class="dz-preview dz-file-preview"  id="preview-template-silde-freschi" style="display: none;">
        <div class="dz-details">
          <div class="dz-filename"><span data-dz-name></span></div>
          <div class="dz-size" data-dz-size></div>
          <img data-dz-thumbnail />
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-success-mark"><span>✔</span></div>
        <div class="dz-error-mark"><span>✘</span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
      </div>
    </div>
  </div>

  <hr>


  {{-- PRODOTTI CONFEZIONATI SLIDE --}}
  <div class="sldeProdotti">

    <div class="row">
      <h2>Prodotti confezionati</h2>
    </div>
      
    @if ($slide_confezionati->immagini->count())
      @foreach ($slide_confezionati->immagini as $immagine)
        <div class="row">
            <div class="col-md-3"> 
              <img src="{{ url('images/'.$immagine->nome) }}" width="125" height="100">
            </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-default delete_image_slide" data-id="{{$immagine->id}}">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
            </div>
          </div>    
        @endforeach
      @else
        <p>Nessuna immagine caricata ancora</p>
      @endif

  </div>

  <div class="row margin">
    <div class="col-md-12"> 
      <form  method="POST" action="{{ route('homepage.uploadSlideProdttiConfezionati') }}" class="dropzone"  enctype="multipart/form-data" id="formUploadSlideProdttiConfezionati">
        {{ csrf_field() }}
        <input type="hidden" name="slide_id" value="{{$slide_confezionati->id}}">
      </form>
    </div>
  </div>

  <div class="row margin">
    <div class="col-md-12">
      <div class="dz-preview dz-file-preview"  id="preview-template-silde-freschi" style="display: none;">
        <div class="dz-details">
          <div class="dz-filename"><span data-dz-name></span></div>
          <div class="dz-size" data-dz-size></div>
          <img data-dz-thumbnail />
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-success-mark"><span>✔</span></div>
        <div class="dz-error-mark"><span>✘</span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
      </div>
    </div>
  </div>



@stop


    @section('script_head')
      <script src="{{ url('js/dropzone.js') }}"></script>
    @stop

    @section('script')


      


      <script type="text/javascript">



            $( document ).ready(function() {

                // eliminazione immagini header
                $("button.delete_image_slide").click(function(e){
                  if (confirm('Sei sicuro di voler eliminare l\'immagine?')) {
                    var id = jQuery(this).data('id');
                    var data = {
                                "_token": "{{ csrf_token() }}",
                                id:id,
                                };
                    $.ajax({ url: "{{route('homepage.deleteSliderImage')}}",
                             data: data,
                             type: 'post',
                             success: function(output) 
                              {
                              window.location.reload(true);
                              }
                    });
                  };
                });


                // eliminazione immagini negozi

                $("button.delete_image_negozio").click(function(e){
                  if (confirm('Sei sicuro di voler eliminare l\'immagine?')) {
                    var colname = jQuery(this).data('colname');
                    var data = {
                                "_token": "{{ csrf_token() }}",
                                colname:colname,
                                };
                    $.ajax({ url: "{{route('homepage.deleteNegozioImage')}}",
                             data: data,
                             type: 'post',
                             success: function(output) 
                              {
                              window.location.reload(true);
                              }
                    });
                  };
                });




            });




            Dropzone.options.formUploadSlideHeader = {
              paramName: "file", // The name that will be used to transfer the file
              maxFilesize: 2, // MB
              acceptedFiles: ".jpeg,.jpg,.png,.gif",
              dictDefaultMessage: "Clicca o trascina qui i file da caricare nella header slide",
              //previewTemplate: document.getElementById('preview-template-silde-header').innerHTML,
              accept: function(file, done) {
                if (file.name == "xxx.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              },
              init: function () {
                this.on("complete", function (file) {
                  if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    setTimeout(function(){ location.reload(); }, 1000);
                  }
                });
              }
            };

             Dropzone.options.formUploadSlideProdttiFreschi = {
              paramName: "file", // The name that will be used to transfer the file
              maxFilesize: 3, // MB
              acceptedFiles: ".jpeg,.jpg,.png,.gif",
              dictDefaultMessage: "Clicca o trascina qui i file da caricare nella slide prdotti freschi",
              //previewTemplate: document.getElementById('preview-template-silde-freschi').innerHTML,
              accept: function(file, done) {
                if (file.name == "xxx.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              },
              init: function () {
                this.on("complete", function (file) {
                  if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    setTimeout(function(){ location.reload(); }, 1000);
                  }
                });
              }
            };

             Dropzone.options.formUploadSlideProdttiConfezionati = {
              paramName: "file", // The name that will be used to transfer the file
              maxFilesize: 2, // MB
              acceptedFiles: ".jpeg,.jpg,.png,.gif",
              dictDefaultMessage: "Clicca o trascina qui i file da caricare nella slide prdotti confezionati",
              //previewTemplate: document.getElementById('preview-template-silde-freschi').innerHTML,
              accept: function(file, done) {
                if (file.name == "xxx.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              },
              init: function () {
                this.on("complete", function (file) {
                  if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    setTimeout(function(){ location.reload(); }, 1000);
                  }
                });
              }
            };
    </script>

    @stop
