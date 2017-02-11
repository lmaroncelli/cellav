<!-- FlatFy Theme - Andrea Galanti /-->
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="@yield('seo_description')">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
    	@if (isset($page))
    	  {{$page->title}}
    	@else
    	  @yield('seo_title')
    	@endif
    </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('frontend_new/assets/css/bootstrap.min.css') }}" rel="stylesheet">
 
    <!-- Custom Google Web Font -->
    <link href="{{ url('frontend_new/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
	
	<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700|Playball" rel="stylesheet">
	
    <!-- Custom CSS-->
    <link href="{{ url('frontend_new/assets/css/general.css') }}" rel="stylesheet">
	
	 <!-- Owl-Carousel -->
    <link href="{{ url('frontend_new/assets/css/custom.css') }}" rel="stylesheet">
	<link href="{{ url('frontend_new/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ url('frontend_new/assets/css/owl.theme.css') }}" rel="stylesheet">
	<link href="{{ url('frontend_new/assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('frontend_new/assets/css/custom.css') }}" rel="stylesheet">

	<link href="{{ url('frontend_new/assets/css/animate.css') }}" rel="stylesheet">
	
	<!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="{{ url('frontend_new/assets/css/magnific-popup.css') }}"> 
	
	<script src="{{ url('frontend_new/assets/js/modernizr-2.8.3.min.js') }}"></script>  <!-- Modernizr /-->
	<!--[if IE 9]>
		<script src="{{ url('frontend_new/assets/js/PIE_IE9.js') }}"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="{{ url('frontend_new/assets/js/PIE_IE678.js') }}"></script>
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="{{ url('frontend_new/assets/js/html5shiv.js') }}"></script>
	<![endif]-->

	@yield('css')
	
	<!-- Scripts -->
	<script>
	    window.Laravel = <?php echo json_encode([
	        'csrfToken' => csrf_token(),
	    ]); ?>
	</script>
	
	@yield('script_head')

</head>

<body id="home">

	<!-- Preloader -->
	<div id="preloader">
		<div id="status"></div>
	</div>
		
	@yield('menu','no menu')
	
	@yield('header','no header')	

	@include('admin.show_errors')
	
	@yield('content')
	
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h3 class="footer-title">Follow Me!</h3>
            <p>Vuoi ricevere news su altri template?<br/>
              Visita Andrea Galanti.it e vedrai tutte le news riguardanti nuovi Theme!<br/>
              Go to: <a  href="http://andreagalanti.it" target="_blank">andreagalanti.it</a>
            </p>
			
			<!-- LICENSE -->
			<a rel="cc:attributionURL" href="http://www.andreagalanti.it/flatfy"
		   property="dc:title">Flatfy Theme </a> by
		   <a rel="dc:creator" href="http://www.andreagalanti.it"
		   property="cc:attributionName">Andrea Galanti</a>
		   is licensed to the public under 
		   <BR>the <a rel="license"
		   href="http://creativecommons.org/licenses/by-nc/3.0/it/deed.it">Creative
		   Commons Attribution 3.0 License - NOT COMMERCIAL</a>.
		   
	   
          </div> <!-- /col-xs-7 -->

          <div class="col-md-5">
            <div class="footer-banner">
              <h3 class="footer-title">Flatfy Theme</h3>
              <ul>
                <li>12 Column Grid Bootstrap</li>
                <li>Form Contact</li>
                <li>Drag Gallery</li>
                <li>Full Responsive</li>
                <li>Lorem Ipsum</li>
              </ul>
              Go to: <a href="http://andreagalanti.it/flatfy" target="_blank">andreagalanti.it/flatfy</a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ url('frontend_new/assets/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ url('frontend_new/assets/js/bootstrap.js') }}"></script>
	<script src="{{ url('frontend_new/assets/js/owl.carousel.js') }}"></script>
	<script src="{{ url('frontend_new/assets/js/script.js') }}"></script>
	<!-- StikyMenu -->
	<script src="{{ url('frontend_new/assets/js/stickUp.min.js') }}"></script>
	<script type="text/javascript">
	  jQuery(function($) {
		$(document).ready( function() {
		  $('.navbar-default').stickUp();
		  
		});
	  });
	
	</script>
	<!-- Smoothscroll -->
	<script type="text/javascript" src="{{ url('frontend_new/assets/js/jquery.corner.js') }}"></script> 
	<script src="{{ url('frontend_new/assets/js/wow.min.js') }}"></script>
	<script>
	 new WOW().init();
	</script>
	<script src="{{ url('frontend_new/assets/js/classie.js') }}"></script>
	{{-- <script src="{{ url('frontend_new/assets/js/uiMorphingButton_inflow.js') }}"></script> --}}
	<!-- Magnific Popup core JS file -->
	<script src="{{ url('frontend_new/assets/js/jquery.magnific-popup.js') }}"></script> 

	@yield('feed_map')    

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqImK9lRFJdcFLSt0W-t_QQC70fCsCwV0&callback=initMap">
    </script>
</body>

</html>
