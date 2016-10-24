@extends('admin.layouts.backend')

@section('css')
	<link href="/css/supernote.css" rel="stylesheet">
@stop

@section('title')
	{{ $prodotto->exists ? 'Modifica Prodotto' : 'Nuova Prodotto'}}
@stop

@section('content')
	

	@if ($prodotto->exists)
		<form  method="POST" action="{{ route('prodotti.update', $prodotto->id) }}">
		{{ method_field('PUT') }}
	@else
		<form  method="POST" action="{{ route('prodotti.store') }}">
	@endif
		
		{{ csrf_field() }}
		  
      <div class="form-group">
        <label for="codice">Produttore</label>
        <select class="form-control" name="produttore_id">
          @foreach ($produttori as $key => $nome)
            <option value="{{$key}}" @if(old('produttore_id') == $key) selected @endif>{{$nome}}</option>
          @endforeach
        </select>
      </div>
			<div class="form-group">
	    	<label for="codice">Codice</label>
	    	<input type="text" class="form-control" id="codice" placeholder="Codice" name="codice" value="{{old('codice', isset($prodotto->codice) ? $prodotto->codice : null)}}">
	  	</div>

	  	<div class="form-group">
	    	<label for="nome">Nome</label>
	    	<input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{old('nome', isset($prodotto->nome) ? $prodotto->nome : null)}}">
	  	</div>

	  	<div class="form-group">
	    	<label for="peso">Peso</label>
	    	<input type="text" class="form-control" id="peso" placeholder="Peso" name="peso" value="{{old('peso', isset($prodotto->peso) ? $prodotto->peso : null)}}">
	  	</div>


		<div class="form-group">
		  	<label for="nome">Descrizione</label>
	  		<textarea class="form-control" rows="3" name="descrizione" id="descrizione">{{old('descrizione', isset($prodotto->descrizione) ? $prodotto->descrizione : null)}}</textarea>
		</div>

		<div class="form-group">
		  	<label for="nome">Scheda tecnica</label>
	  		<textarea class="form-control" rows="3" name="scheda" id="scheda">{{old('scheda', isset($prodotto->scheda) ? $prodotto->scheda : null)}}</textarea>
		</div>

		<div class="form-group">
		  	<label for="nome">Ingredienti</label>
	  		<textarea class="form-control" rows="3" name="ingredienti" id="ingredienti">{{old('ingredienti', isset($prodotto->ingredienti) ? $prodotto->ingredienti : null)}}</textarea>
		</div>
    
    <div class="form-group">
    <label for="disponibile">Caratteristiche</label>
    <div class="checkbox">
        @foreach ($caratteristiche as $key => $nome)
        <label>
          <input type="checkbox" id="{{$nome}}" name="caratteristiche[]" value="{{$key}}" aria-label="{{$nome}}" @if (old($nome)==1) checked @endif> 
          {{$nome}}
        </label>
        @endforeach
    </div>
    </div>

    <div class="form-group">
    <label for="disponibile">Categorie</label>
    <div class="checkbox">
        @foreach ($categorie as $key => $nome)
        <label>
          <input type="checkbox" id="{{$nome}}" name="categorie[]" value="{{$key}}" aria-label="{{$nome}}" @if (old($nome)==1) checked @endif> 
          {{$nome}}
        </label>
        @endforeach
    </div>
    </div>

    <div class="form-group">
      <label for="nome">URI</label>
      <input type="text" class="form-control" id="uri" placeholder="URI" name="uri" value="{{old('uri', isset($prodotto->uri) ? $prodotto->uri : null)}}">
    </div>

    <div class="form-group">
      <label for="prezzo">Prezzo</label>
      <input type="text" class="form-control" id="prezzo" placeholder="Prezzo" name="prezzo" value="{{old('prezzo', isset($prodotto->prezzo) ? $prodotto->prezzo : null)}}">
    </div>
    
    <div class="form-group">
      <label for="prezzo_offerta">Prezzo offerta</label>
      <input type="text" class="form-control" id="prezzo_offerta" placeholder="Prezzo offerta" name="prezzo_offerta" value="{{old('prezzo_offerta', isset($prodotto->prezzo_offerta) ? $prodotto->prezzo_offerta : null)}}">
    </div>

    <div class="form-group">
      <label for="disponibile">Disponibile</label>
      <input type="text" class="form-control" id="disponibile" placeholder="Disponibile" name="disponibile" value="{{old('disponibile', isset($prodotto->disponibile) ? $prodotto->disponibile : null)}}">
    </div>
    

  	<div class="checkbox">
  	  <label>
  	    <input type="checkbox" id="novita" name="novita" value="1" aria-label="Novità" @if (old('novita')==1) checked @endif> 
  	    	Novità
  	   </label>
  	</div>

  	<div class="checkbox">
  	  <label>
  	    <input type="checkbox" id="offerta" name="offerta" value="1" aria-label="Offerta" @if (old('offerta')==1) checked @endif> 
  	    	Offerta
  	   </label>
  	</div>

  	<div class="checkbox">
  	  <label>
  	    <input type="checkbox" id="visibile" name="visibile" value="1" aria-label="Visibile" @if (old('visibile')==1) checked @endif> 
  	    	Visibile
  	   </label>
  	</div>

    <div class="form-group">
      <label for="scadenza">Scadenza</label>
      <input type="text" class="form-control" id="scadenza" placeholder="scadenza" name="scadenza" value="{{old('scadenza', isset($prodotto->scadenza) ? $prodotto->scadenza : null)}}">
    </div>


		<button type="submit" class="btn btn-primary">{{ $prodotto->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

@stop


@section('script')
	<script>
	     $(document).ready(function(){

	        $('#descrizione').summernote({
              height:250,
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

	        $('#scheda').summernote({
              height:250,
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


	        $('#ingredienti').summernote({
              height:250,
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