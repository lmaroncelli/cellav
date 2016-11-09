@extends('layouts.frontend')

@section('title')
	Il tuo carrello
@stop

@section('content')
    <h1>Checkout</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Prodotti</th>
            <th>Prezzo</th>
            <th class="text-center">Q.tà</th>
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
                <td class="col-sm-1 col-md-1 text-center"><strong>€ {{$prodottoCarrello->prezzo}}</strong></td>
                <td class="col-sm-1 col-md-1" style="text-align: center">{{$prodottoCarrello->numero}}</td>
                <td class="col-sm-1 col-md-1 text-center">€ {{$prodottoCarrello->prezzo * $prodottoCarrello->numero}}</td>
            </tr>
        @endforeach

        <tr>
            <td>   </td>
            <td>   </td>
            <td><h3>Total</h3></td>
            <td colspan="2" class="text-left"><h3><strong>€ {{$total}}</strong></h3></td>
        </tr>
        </tbody>
    </table>
    <form action="{{ route('checkout') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name"  class="form-control" value="{{old('name', isset($user->name) ? $user->name : null)}}" required>
                  </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Compra</button>
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{config('services.stripe.key')}}"
            data-amount="{{$total}}"
            data-name="EcommerceWeb"
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-zip-code="true"
            data-currency="eur">
          </script>


    </form>
	     
@stop