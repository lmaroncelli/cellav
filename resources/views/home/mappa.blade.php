<div class="row mappa">
  <div class="col-md-3 text-center">
    <h3 class="section-heading">
    Contatti
    </h3>
    <div class="sub-title lead3">
       DOVE TROVARCI
    </div>
    <label>TROVA ITINERARIO</label>
    <input type="text" class="form-control" placeholder="Via Tonti,16 Rimini" id="partenza" value="{{old('partenza')}}">
    <p>
    	{!!nl2br($homepage->gm_indirizzo)!!}
    </p>
  	<input id="submitMappa" type="button" class="btn btn-default btn-xs" value="trova percorso sulla mappa">
  </div>
  <div class="col-md-9">
    <div id="map"></div>
  </div>
 </div>