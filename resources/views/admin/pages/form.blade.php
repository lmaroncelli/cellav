@extends('admin.layouts.backend')

@section('title')
	{{ $page->exists ? 'Modifica Pagina' : 'Nuova pagina'}}
@stop

@section('content')

	@if ($page->exists)
		<form action="{{ route('pages.update', $page->id) }}" method="PUT">
	@else
		<form action="{{ route('pages.store') }}" method="POST">
	@endif
		
		{{ csrf_field() }}
		
		<div class="form-group">
	    	<label for="titolo">Titolo</label>
	    	<input type="text" class="form-control" id="titolo" placeholder="Titolo" name="title" value="{{old('title', isset($page->title) ? $page->title : null)}}">
	  	</div>

	  	<div class="form-group">
	    	<label for="nome">Nome</label>
	    	<input type="text" class="form-control" id="nome" placeholder="Nome" name="name" value="{{old('name', isset($page->name) ? $page->name : null)}}">
	  	</div>

	  	<div class="form-group">
	    	<label for="nome">URI</label>
	    	<input type="text" class="form-control" id="uri" placeholder="URI" name="uri" value="{{old('uri', isset($page->uri) ? $page->uri : null)}}">
	  	</div>

		<div class="form-group">
		  	<label for="nome">Content</label>
	  		<textarea class="form-control" rows="3" name="content" id="content">{{old('content', isset($page->content) ? $page->content : null)}}</textarea>
		</div>
		
		<button type="submit" class="btn btn-primary">{{ $page->exists ? 'Modifica' : 'Salva'}}</button>

	</form>

@stop


@section('script')
	<script>
	     $(document).ready(function(){

	         $('#nome').blur(function(event){
	             alert($(this).val());
	           uri = $("#uri");

	           if (uri.val() == '') {

	             val = $(this).val();
	             
	             $.ajax({
	               url: '<?=url("admin/pages/uri_ajax") ?>',
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

	     });

	</script>
@stop