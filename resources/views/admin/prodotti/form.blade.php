@extends('admin.layouts.backend')

@section('css')
	<link href="/css/supernote.css" rel="stylesheet">
@stop

@section('title')
	{{ $prodotto->exists ? 'Modifica Pagina' : 'Nuova pagina'}}
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
	    	<label for="titolo">Titolo</label>
	    	<input type="text" class="form-control" id="titolo" placeholder="Titolo" name="title" value="{{old('title', isset($prodotto->title) ? $prodotto->title : null)}}">
	  	</div>

	  	<div class="form-group">
	    	<label for="nome">URI</label>
	    	<input type="text" class="form-control" id="uri" placeholder="URI" name="uri" value="{{old('uri', isset($prodotto->uri) ? $prodotto->uri : null)}}">
	  	</div>

		<div class="form-group">
		  	<label for="nome">Content</label>

	  		<textarea class="form-control" rows="3" name="content" id="content">{{old('content', isset($prodotto->content) ? $prodotto->content : null)}}</textarea>
		</div>
		
		<button type="submit" class="btn btn-primary">{{ $prodotto->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

@stop


@section('script')
	<script>
	     $(document).ready(function(){

	         $('#titolo').blur(function(event){
	             
	           uri = $("#uri");

	           if (uri.val() == '') {

	             val = $(this).val();
	             
	             $.ajax({
	               url: '<?=url("admin/prodotti/uri_ajax") ?>',
	               type: "post",
	               data : { 
	                 'value': val,
	                 '_token': '{{ csrf_token() }}'
	               },
	               success: function(data) {
	                 uri.val(data);
	               }
	             });
	           
	           }

	         });

	        $("#content").summernote({
              height:500,
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