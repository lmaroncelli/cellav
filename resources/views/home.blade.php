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
					<li class="menuItem text-center"><a href="#whatis">NEGOZI</a></li>
					<li class="menuItem text-center"><a href="#useit">PRODOTTI FRESCHI</a></li>
					<li class="menuItem text-center"><a href="#screen">PRODOTTI CONFEZIONATI</a></li>
					<li class="menuItem text-center"><a href="#credits">SHOP ONLINE</a></li>
					<li class="menuItem text-center"><a href="#contact">BLOG</a></li>
					<li class="menuItem text-center"><a href="#contact">CELIACHIA: COS'E'</a></li>
					<li class="menuItem text-center"><a href="#contact">CONTATTI</a></li>
				</ul>
			</div>
		   
		</div>
	</nav> 
@stop


@section('header')
	<!-- FullScreen -->
    <div class="intro-header">    
        <!-- /.container -->
    </div>
@stop

@section('content')
	
		{{-- negozi --}}
		<div id="whatis" class="content-section-b" style="border-top: 0">
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

		

	{{-- 

	@if (!is_null($first_header_image))
		@include('home.slider')
	@endif

  @include('home.negozi')

	@if (!is_null($slide_freschi))
  		@include('home.prodotti_freschi')
	@endif
	
	@if (!is_null($slide_confezionati))
  		@include('home.prodotti_confezionati')
	@endif

	

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

