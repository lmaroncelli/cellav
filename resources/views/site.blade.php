@extends('layouts.frontend')

@section('title')
	{{$page->title}}
@stop

@section('content')
	{!! $page->content !!}
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
@stop