<div class="row">
  <h3>negozi</h3>
  @foreach (['magliana','cipro','tiburtina'] as $negozio)
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <div class="caption">
          <h3>CELIACHIAMO {{$negozio}}</h3>
          <?php 
            $img = 'img_'.$negozio;
            $desc = 'desc_'.$negozio;
          ?>
          <img src="{{ url('images/'.$homepage->$img) }}" class="img-circle" width="242" height="200">
          <p>{{ $homepage->$desc }}</p>
          <p><a href="#" class="btn btn-default" role="button">Visualizza</a></p>
        </div>
      </div>
    </div>
  @endforeach
</div>