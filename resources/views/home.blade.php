@extends('layouts.frontend')

@section('title')

	homepage

@stop

@section('css')
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="{{ url('frontend/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

	<link href="{{ url('frontend/assets/css/jquery.bxslider.css') }}" rel="stylesheet">

@stop

@section('content')
	
	@if (!is_null($first_header_image))
		@include('home.slider')
	@endif

  @include('home.negozi')

  @include('home.prodotti_freschi')

	Che bella home page !!!

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

