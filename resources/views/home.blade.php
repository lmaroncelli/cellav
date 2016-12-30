@extends('layouts.frontend')

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

@section('content')
	
	@if (!is_null($first_header_image))
		@include('home.slider')
	@endif

  @include('home.negozi')

	@if (!is_null($slide_freschi))
  		@include('home.prodotti_freschi')
	@endif

	<div>
	{{$homepage->content}}	
	</div>

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

