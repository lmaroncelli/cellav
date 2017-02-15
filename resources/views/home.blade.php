@extends('layouts.frontend_new')

@section('seo_title'){!!$homepage->seo_title!!}@stop
@section('seo_description'){!!$homepage->seo_description!!}@stop


@section('css')
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="{{ url('frontend/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

	<link href="{{ url('frontend/assets/css/jquery.bxslider.css') }}" rel="stylesheet">

@stop

@section('title')
	Celiachiamo.com
@stop


@section('menu')
	<!-- NavBar-->
	<nav class="navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header text-left">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#home">HOME</a>
			</div>

			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="menuItem text-center"><a href="#negozi">NEGOZI</a></li>
					<li class="menuItem text-center"><a href="#freschi">PRODOTTI FRESCHI</a></li>
					<li class="menuItem text-center"><a href="#confezionati">PRODOTTI CONFEZIONATI</a></li>
					<li class="menuItem text-center"><a href="#shop_online">SHOP ONLINE</a></li>
					<li class="menuItem text-center"><a href="#blog">BLOG</a></li>
					<li class="menuItem text-center"><a href="#celiachia">CELIACHIA: COS'E'</a></li>
					<li class="menuItem text-center"><a href="#contact">CONTATTI</a></li>
				</ul>
			</div>
		   
		</div>
	</nav> 
@stop


@section('header')
	<!-- FullScreen -->
    <div class="intro-header" style="height: 100%; padding-top: 50px; padding-bottom: 50px; color: #f8f8f8; background: url('{{ $first_header_image }}') no-repeat center center">
    </div>
@stop

@section('content')
	
		{{-- negozi --}}
		<div id="negozi" class="content-section-b" style="border-top: 0">
			<div class="container">

				<div class="col-md-6 col-md-offset-3 text-center wrap_title">
					<h2>Negozi</h2>
					<p class="lead" style="margin-top:0">LE TRE CASE DEL SENZA GLUTINE</p>
				</div>
				
				@include('home.negozi')

			</div>
		</div>
		
		{{-- prodotti freschi --}}
		@if (!is_null($slide_freschi))
	  		@include('home.prodotti_freschi')
		@endif

		@if (!is_null($slide_confezionati))
	  		@include('home.prodotti_confezionati')
		@endif

		{{-- PARALLAX --}}
		<div class="parallax" style="background-image: url({{url('frontend_new/assets/img/parallax_1_light.jpg')}});"></div>
		{{-- FINE PARALLAX --}}

		
		@if ($prodotti->count())
	  		@include('home.prodotti');
		@endif
		

		{{-- PARALLAX --}}
		<div class="parallax" style="background-image: url({{url('frontend_new/assets/img/parallax_2_light.jpg')}});"></div>
		{{-- FINE PARALLAX --}}

		@include('home.social_fan_pages');		

		{{-- CELIACHIA COS'E' --}}
		<div id="celiachia" class="banner">
			
		</div>
		{{-- FINE CELIACHIA COS'E' --}}

		@if ($homepage->gm_lat != '' && $homepage->gm_long != '')
	  		@include('home.mappa')

	  		@section('feed_map')
	  				{{-- carica le variabile js con i valori della pagina  --}}
	  				<script>
	  					var $lat = {{$homepage->gm_lat}};
	  					var $long = {{$homepage->gm_long}};
	  					var $info = "{{ $homepage->gm_info }}";

	  					var $lat2 = {{$homepage->gm_lat2}};
	  					var $long2 = {{$homepage->gm_long2}};
	  					var $info2 = "{{ $homepage->gm_info2 }}";

	  					var $lat3 = {{$homepage->gm_lat3}};
	  					var $long3 = {{$homepage->gm_long3}};
	  					var $info3 = "{{ $homepage->gm_info3 }}";
	  					
	  				</script>
	  				<script src={{ url('frontend_new/assets/js/custom.js') }}></script>
	  		@stop
		@endif
		

	{{-- 
	<div>
	{{$homepage->content}}	
	</div>
 --}}

@stop


@section('script')
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src={{ url('frontend/assets/js/ie10-viewport-bug-workaround.js') }}></script>

	<script src="{{ url('frontend/assets/js/bxslider/jquery.bxslider.min.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
		  $('.bxslider').bxSlider({
		  	adaptiveHeight: true,
		  	 mode: 'fade'
		  });
		});
	</script>
@stop

