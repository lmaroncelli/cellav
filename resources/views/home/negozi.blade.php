<div class="row">
  @foreach (['magliana','cipro','tiburtina'] as $negozio)
    <?php 
      $img = 'img_'.$negozio;
      $desc = 'desc_'.$negozio;
    ?>
    <div class="col-sm-4 wow fadeInDown text-center">
      <img class="rotate" src="{{ url('images/'.$homepage->$img) }}" width="242" height="200" alt="Generic placeholder image">
      <h3>CELIACHIAMO {{$negozio}}</h3>
      <p class="lead">{{ $homepage->$desc }}</p>
      <p><a class="btn btn-embossed btn-primary view" role="button">Visualizza</a></p>
    </div><!-- /.col-lg-4 -->
   @endforeach
</div><!-- /.row -->