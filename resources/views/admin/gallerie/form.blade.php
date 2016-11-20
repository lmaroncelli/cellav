@extends('admin.layouts.backend')

@section('css')
	<link href="/css/supernote.css" rel="stylesheet">
@stop

@section('title')
	{{ $galleria->exists ? 'Modifica Galleria' : 'Nuova Galleria'}}
@stop

@section('content')
  
  @if ($galleria->exists)
    <form  method="POST" action="{{ route('gallerie.upload') }}" class="dropzone"  enctype="multipart/form-data" id="formUpload">
      {{ csrf_field() }}
      <input type="hidden" name="galleria_id" value="{{$galleria->id}}">
    </form>
  @endif



  @if ($galleria->exists)
    <form  method="POST" action="{{ route('gallerie.update', $galleria->id) }}">
    {{ method_field('PUT') }}
    

  @else
    <form  method="POST" action="{{ route('gallerie.store') }}">
  @endif
    
    {{ csrf_field() }}

      <div class="form-group">
        <label for="titolo">Titolo</label>
        <input type="text" class="form-control" id="titolo" placeholder="Titolo" name="titolo" value="{{old('titolo', isset($galleria->titolo) ? $galleria->titolo : null)}}">
      </div>
      
       
		<button type="submit" class="btn btn-primary">{{ $galleria->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

  <div id="preview-template" style="display: block;"></div>





@stop

@if ($galleria->exists)

    @section('script_head')
      <link rel="stylesheet" href="/css/dropzone/dropzone.css">
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

@endif