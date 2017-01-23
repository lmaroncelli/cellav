@extends('admin.layouts.backend')

@section('css')
	<link href="/css/supernote.css" rel="stylesheet">
@stop

@section('title')
	{{ $slide->exists ? 'Modifica slide' : 'Nuovo slide'}}
@stop

@section('content')
	

	@if ($slide->exists)
		<form  method="POST" action="{{ route('slide-categorie.update', $slide->id) }}" enctype="multipart/form-data">
		{{ method_field('PUT') }}
	@else
		<form  method="POST" action="{{ route('slide-categorie.store') }}" enctype="multipart/form-data">
	@endif
		
		{{ csrf_field() }}
		

		<div class="form-group">
    	<label for="titolo">Titolo</label>
    	<input type="text" class="form-control" id="titolo" placeholder="widget prodotti confezionati Magliana" name="titolo" value="{{old('titolo', isset($slide->titolo) ? $slide->titolo : null)}}">
  	</div>
	  	
    <hr />
    

    {{-- 3 elementi --}}
    
      <div id="exTab2"> 

        <ul class="nav nav-tabs">
          @foreach ($categorie as $id => $nome)
            <?php 
            ($id==1) ? $class_active='active' : $class_active=''; 
            ?>
            <li class="{{$class_active}}">
              <a  href="#{{$id}}" data-toggle="tab">{{$nome}}</a>
            </li>
          @endforeach
        </ul>

        <div class="tab-content">
          
         @foreach ($categorie as $id => $nome)
          <?php 
          $img = "img_$id";
          $nome = "nome_$id";
          $desc = "desc_$id";
          $url_pagina = "url_pagina_$id";
          ($id==1) ? $class_active='active' : $class_active=''; 
          ?>
          <div class="tab-pane {{$class_active}}" id="{{$id}}">
            <h3>Inserisci i dati per la categoria  {{$nome}}</h3>
            <p>
              @if (is_null($slide->$img) || $slide->$img == '')
                <div class="form-group">
                  <label for="titolo">Immagine</label>
                  <input type="file" class="form-control" id="img" name="img_{{$id}}">
                </div>
              @else
                <img src="{{ url('images/'.$slide->$img) }}" width="100" height="50">
                <button type="button" class="btn btn-default delete_image_negozio" data-colname="img_{{$id}}">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              @endif
              
              <div class="form-group">
                  <label for="{{$nome}}">Nome</label>
                <input type="text" class="form-control" id="{{$nome}}" placeholder="Titolo" name="{{$nome}}" value="{{old('$nome', isset($slide->$nome) ? $slide->$nome : null)}}">
              </div>
              
              <div class="form-group">
                <label for="{{$desc}}">Descrizione</label>
                <textarea class="form-control" rows="3" name="{{$desc}}">{{old('$desc', isset($slide->$desc) ? $slide->$desc : null)}}</textarea>
              </div>

                <div class="form-group">
                  <label for="{{$url_pagina}}">URL pagina</label>
                <input type="text" class="form-control" id="{{$url_pagina}}" placeholder="URI" name="{{$url_pagina}}" value="{{old('$url_pagina', isset($slide->$url_pagina) ? $slide->$url_pagina : null)}}">
                </div>
            </p>
          </div>
          @endforeach

      
        </div> {{-- //.tab-content --}}
       
    </div> {{-- end exTab2 --}}

    {{--  FINE 3 elementi --}}
		
		<button type="submit" class="btn btn-primary">{{ $slide->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

@stop


@section('script')
	<script>
	     $(document).ready(function(){

	        $("#descrizione").summernote({
              height:200,
              toolbar: [
                 // [groupName, [list of button]]
                 ['Insert', ['picture', 'link', 'video', 'table','hr']],
                 ['style', ['bold', 'italic', 'underline','strikethrough', 'clear']],
                 ['fontsize', ['fontsize']],
                 ['fontname', ['fontname']],
                 ['color', ['color']],
                 ['para', ['ul', 'ol', 'paragraph']],
                 ['height', ['height']],
                 ['Misc',['fullscreen','codeview']]
               ],

            });

	     });

	</script>

@stop