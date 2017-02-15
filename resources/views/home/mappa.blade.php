<div class="row mappa">
  <div class="col-md-3 text-center">
    <h3 class="section-heading">
    Contatti
    </h3>
    <div class="sub-title lead3">
       DOVE TROVARCI
    </div>
    <div class="form-group">
      <label>TROVA ITINERARIO</label>
      <input type="text" class="form-control" placeholder="Via Tonti,16 Rimini" id="partenza" value="{{old('partenza')}}">
    </div>
      <input id="submitMappa" type="button" class="btn btn-default btn-xs" value="trova percorso sulla mappa">
    <p>
      {!!nl2br($homepage->gm_indirizzo)!!}
    </p>
  </div>
  <div class="col-md-9">
    <div id="map"></div>
  </div>
 </div>
 <div class="row istruzioni_mappa">
   <div class="col-md-offset-2 col-md-8">
     <div id="right-panel"></div>
   </div>
 </div>

