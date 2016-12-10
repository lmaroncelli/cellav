<div class="row">
  <h3>negozi</h3>
  @foreach (['LAB','CIPRO','TIBURTINA'] as $negozio)
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <div class="caption">
          <h3>CELIACHIAMO {{$negozio}}</h3>
          <img src="{{ url('frontend/assets/img/newyork.jpg') }}" class="img-circle" width="242" height="200">
          <p>Nullam eu ipsum arcu. Donec imperdiet lectus enim, congue maximus quam sodales id.</p>
          <p><a href="#" class="btn btn-default" role="button">Visualizza</a></p>
        </div>
      </div>
    </div>
  @endforeach
</div>