@extends('layouts.frontend')

@section('title')
	Il tuo carrello
@stop

@section('content')

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Prodotti</th>
            <th>Prezzo</th>
            <th class="text-center">Q.tà</th>
            <th></th>
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
                <td class="col-sm-1 col-md-1 text-center"><strong>€ {{$prodottoCarrello->prodotto->prezzo}}</strong></td>
                <td class="col-sm-1 col-md-1" style="text-align: center">{{$prodottoCarrello->numero}}</td>
                <td class="col-sm-1 col-md-1">
                    <select name="qty" id="qty" class="form-control" title="Cart Quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </td>
                <td class="col-sm-1 col-md-1 text-center">€ {{$prodottoCarrello->prodotto->prezzo * $prodottoCarrello->numero}}</td>
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

@section('script')

    <script type="text/javascript">

    $("#qty").change(function() {

        var qty = $(this).val();

        alert(qty);
        
        
        var data = {
            qty = qty,
        }
        
        $.ajax({
        
            url: $apertura,
            type: 'GET',
            data: data,
            success: function(msg) {
            
                if (msg=='')  {
                    
                    top.location.href = window.location.href
                    
                } else {
                    
                    $('div.risultati_ricerca').fadeOut('fast', function(){
                        $('div.risultati_ricerca').html(msg);
                        window.assegnaClick();
                        window.checkedCount();

                    });
                    
                    $('div.risultati_ricerca').fadeIn(1000,function(){
                        $('div.wrapper_risultati_ricerca').removeClass('loading');
                    });
                    
                        
                }
                
                window.closeLoading();
            
            }
        
        });

    });
    </script>
@stop