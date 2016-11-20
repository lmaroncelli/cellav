@extends('admin.layouts.backend')

@section('css')
	<link href="/css/supernote.css" rel="stylesheet">
@stop

@section('title')
	{{ $galleria->exists ? 'Modifica Galleria' : 'Nuova Galleria'}}
@stop

@section('content')
  

  @if ($galleria->exists)
    <form  method="POST" action="{{ route('ricette.update', $galleria->id) }}" enctype="multipart/form-data">
    {{ method_field('PUT') }}
  @else
    <form  method="POST" action="{{ route('ricette.store') }}" enctype="multipart/form-data">
  @endif
    
    {{ csrf_field() }}

      <div class="form-group">
        <label for="titolo">Titolo</label>
        <input type="text" class="form-control" id="titolo" placeholder="Titolo" name="titolo" value="{{old('titolo', isset($galleria->titolo) ? $galleria->titolo : null)}}">
      </div>

      


		<button type="submit" class="btn btn-primary">{{ $galleria->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

@stop


@section('script')
	<script>
	     $(document).ready(function(){

	     });

	</script>

@stop