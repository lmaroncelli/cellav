  <div class="row">
  @foreach (['magliana','cipro','tiburtina'] as $count => $negozio)
    <?php 
      $img = 'img_'.$negozio;
      $desc = 'desc_'.$negozio;
      if ($count == 0) 
        {
        $class= "slideInLeft";
        } 
      elseif($count == 1) 
        {
        $class= "";
        
        }
      else 
        {
        $class= "slideInRight";
        }
      
    ?>
    
    <div class="col-sm-4 wow {{$class}} text-center">
      <img class="rotate" src="{{ url('images/'.$homepage->$img) }}" width="242" height="200" alt="Generic placeholder image">
      <h3> Celiaciamo @if ($count == 0) Lab @elseif($count == 1) Shop @else Tiburtina @endif </h3>
      <p class="lead">{{ $homepage->$desc }}</p>
      <p><a class="btn btn-embossed btn-primary view" role="button">Visualizza</a></p>
    </div><!-- /.col-lg-4 -->
   @endforeach
</div><!-- /.row -->