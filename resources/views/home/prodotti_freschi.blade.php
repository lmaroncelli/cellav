
<div class="row prodotti_freschi">
   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <ul class="bxslider">
              @foreach ($slide_freschi->immagini as $count => $immagine)
						    <li><img src="{{ url('images/'.$immagine->nome) }}" /></li>                
              @endforeach
						</ul>
       </div>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p>Nullam eu ipsum arcu. Donec imperdiet lectus enim, congue maximus quam sodales id.</p>
          <p><a href="#" class="btn btn-default" role="button">Visualizza</a></p>
       </div>
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="embed-responsive embed-responsive-4by3">
					    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/ePbKGoIGAXY"></iframe>
					</div>
       </div>
   </div>
</div>