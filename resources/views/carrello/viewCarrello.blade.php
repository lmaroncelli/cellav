@extends('layouts.frontend')

@section('title')
	Il tuo carrello
@stop

@section('content')

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Prodotti</th>
            <th></th>
            <th class="text-center"></th>
            <th class="text-center">Totale</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($prodottiCarrello as $prodottoCarrello)
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                			Immagine del prodotto
                			<div class="media-body">
                          <h4 class="media-heading"><a href="#">{{$prodottoCarrello->prodotto->nome}}</a></h4>
                      </div>        
                    </div>
                </td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                </td>
                <td class="col-sm-1 col-md-1 text-center"></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>€ {{$prodottoCarrello->prodotto->prezzo}}</strong></td>
                <td class="col-sm-1 col-md-1">
                    <a href="{{ route('carrello.remove', $prodottoCarrello->id )}} "> <button type="button" class="btn btn-danger">
                            <span class="fa fa-remove"></span> Remove
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach

        <tr>
            <td>   </td>
            <td>   </td>
            <td><h3>Total</h3></td>
            <td class="text-right"><h3><strong>€ {{$total}}</strong></h3></td>
        </tr>
        <tr>
            <td>   </td>
            <td>   </td>
            <td>
                <a href="/"> <button type="button" class="btn btn-default">
                        <span class="fa fa-shopping-cart"></span> Continue Shopping
                    </button>
                </a></td>
            <td>
                <button type="button" class="btn btn-success">
                    Checkout <span class="fa fa-play"></span>
                </button></td>
        </tr>
        </tbody>
    </table>
	     
@stop