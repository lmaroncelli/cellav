@extends('layouts.frontend')

@section('title')
	
	{{ isset($page) ? $page->title : $categoriaRicette->nome }}

@stop

@section('content')
	
	@if (isset($page))
		{!! $page->content !!}
	@endif

	@if (isset($prodotti))
	
		<hr/>
		@if (!$prodotti->count())
			Nessun prodotto disponibile
		@else
			@foreach ($prodotti as $prodotto)
				<div>
					<h1>{{ strip_tags($prodotto->nome) }}</h1>
					<form action="{{url( route('carrello.add',$prodotto->id) )}}" method="POST" style="float: right;">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-info">Carrello</button>
					</form>
					<p>{{ str_limit( strip_tags($prodotto->descrizione),200 ) }}</p>
				</div>
				@if (!is_null($prodotto->caratteristiche) && $prodotto->caratteristiche->count())
					<div>
						@foreach ($prodotto->caratteristiche as $caratteristica)
							 {{ $caratteristica->nome }}
						@endforeach
					</div>
				@endif
			@endforeach
		@endif
	
	@endif

	@if (isset($categorieRicette) && !is_null($categorieRicette))
		<ul>
			@foreach ($categorieRicette as $categoria)
				<li>
					<a href="{{ url('categoria/'.$categoria->uri) }}">
						<img src="{{ url('images/'.$categoria->img) }}" width="150" height="100">
						{{$categoria->nome}} ({{$categoria->ricette->count()}})
					</a>
				</li>
			@endforeach
		</ul>
	@endif


	@if (isset($categoriaRicette))
		<h2>Le ricette di "{{$categoriaRicette->nome}}"</h2>
		<ul>
			@foreach ($categoriaRicette->ricette as $ricetta)
				<li>{{$ricetta->titolo}}</li>
			@endforeach
		</ul>
	@endif

@stop