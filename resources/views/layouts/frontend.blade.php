<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>
      @if (isset($page))
        {{$page->title}}
      @else
        @yield('title')
      @endif
    </title>
    

    <!-- Bootstrap core CSS -->
    <link href="{{ url('frontend/assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @yield('css')
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
  </head>


<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">SOLID.</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ url('/pane-pizza-senza-glutine') }}">HOME</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
              @if (Auth::user()->carrelli->count() > 0)
                <li><a href="{{ route('carrello.show') }}">
                    <i class="material-icons">carrello</i><span class="badge green">{{Auth::user()->carrelli()->first()->prodotti()->count()}}</span>  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                </li>
              @endif
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                      <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
                </ul>
              </li>
            @endif

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <!-- *****************************************************************************************************************
     BLUE WRAP
     ***************************************************************************************************************** -->
    <div id="blue">
        <div class="container">
            <div class="row">
                <h3>@yield('title').</h3>
            </div><!-- /row -->
        </div> <!-- /container -->
    </div><!-- /blue -->

     
    <!-- *****************************************************************************************************************
     AGENCY ABOUT
     ***************************************************************************************************************** -->

     <div class="container mtb">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                 @include('admin.show_errors')
                 @yield('content')
            </div>
        </div><! --/row -->
     </div><! --/container -->
    
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src={{ url('frontend/assets/js/bootstrap.min.js') }}></script>
    <script src="{{ url('frontend/assets/js/retina-1.1.0.js') }}"></script>
    <script src="{{ url('frontend/assets/js/jquery.hoverdir.js') }}"></script>
    <script src="{{ url('frontend/assets/js/jquery.hoverex.min.js') }}"></script>
    <script src="{{ url('frontend/assets/js/jquery.prettyPhoto.js') }}"></script>
      <script src="{{ url('frontend/assets/js/jquery.isotope.min.js') }}"></script>
      <script src="{{ url('frontend/assets/js/custom.js') }}"></script>


    @yield('script')
    
</body>
</html>
