@extends('layouts.frontend')



@section('content')
	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
	  		@section('title')
					Ciao {{$user->email}}
				@stop
				<hr>
				<h2>I tuoi ordini</h2>
	
				@foreach ($user->ordini as $ordine)
				
					<div class="panel panel-default">
					  <div class="panel-body">
					    <ul class="list-group">
					    	@foreach ($ordine->prodotti as $prodottoOrdine)

					      	<li class="list-group-item">
					      		n. {{$prodottoOrdine->numero}} {{$prodottoOrdine->prodotto->nome}} <span class="badge">€ {{$prodottoOrdine->prezzo*$prodottoOrdine->numero}}</span>
					      	</li>
					    
					    	@endforeach
					    </ul>
					  </div>
					  <div class="panel-footer"><strong>Totale </strong>€ {{$ordine->totale}}</div>
					</div>
				
				@endforeach
	
	  </div>
	 </div>

@stop