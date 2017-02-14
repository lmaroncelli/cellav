<div id="shop_online">
    <div class="container">
		<div class="row shopping">
			<div class="col-md-offset-4 col-md-4 text-center">
				    <h3 class="section-heading">
				       Shopping Online
				    </h3>
				    <div class="sub-title lead3">
				       CONSEGNE IN TUTTA ITALIA
				    </div>
				    <p class="lead">
				    In his igitur partibus duabus nihil erat, quod Zeno commuta rest gestiret. 
				Sed virtutem ipsam inchoavit, nihil ampliusuma. Scien tiam pollicentur, 
				    </p>
			</div>
		</div>
		<div class="row shopping">
			<div class="col-md-offset-2 col-md-8 text-center">
				<div class="owl-carousel" id="owlshopping">
				@foreach ($prodotti as $prodotto)
					    <div class="item">
							<a class="image-link" href="{{ url('images/'.$prodotto->img_main) }}">
					        <img class="img-responsive" src="{{ url('images/'.$prodotto->img_main) }}"/></img>
							</a>
				            <div class="sub-title lead3">
				              {{$prodotto->nome}}
				            </div>
				            <p class="lead">
				            {{ str_limit(strip_tags($prodotto->descrizione),20) }} 
				            </p>
				            <p class="prezzo">
				            	{{$prodotto->prezzo}} €
				            </p>
				            <p>
				                <a class="btn btn-embossed btn-primary" href="#" role="button">
				                    ACQUISTA
				                </a>
				            </p>
					    </div>
				@endforeach
				</div>
			</div>
		</div>
	</div>
</div>