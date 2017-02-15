var directionsDisplay;
var directionsService;

var marker;
var marker2;
var marker3;

function initMap() {
   var uluru = {lat: $lat, lng: $long};
   var uluru2 = {lat: $lat2, lng: $long2};
   var uluru3 = {lat: $lat3, lng: $long3};
   directionsDisplay = new google.maps.DirectionsRenderer();
   directionsService = new google.maps.DirectionsService();

   var map = new google.maps.Map(document.getElementById('map'), {
     zoom: 12,
     center: uluru,
     styles: mapStyle,
     zoomControl: true,
     mapTypeControl: false,
     scaleControl: false,
     streetViewControl: true,
     rotateControl: false,
     fullscreenControl: false,
     scrollwheel: false,
   });

   directionsDisplay.setMap(map);
   directionsDisplay.setPanel(document.getElementById('right-panel'));

     var infowindow = new google.maps.InfoWindow({
       content: $info
     });

     var infowindow2 = new google.maps.InfoWindow({
       content: $info2
     });

     var infowindow3 = new google.maps.InfoWindow({
       content: $info3
     });
   
   marker = new google.maps.Marker({
     position: uluru,
     map: map,
     title: $info
   });
   marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
  infowindow.open(map, marker);

  marker2 = new google.maps.Marker({
     position: uluru2,
     map: map,
     title:  $info2
   });
   marker2.addListener('click', function() {
    infowindow2.open(map, marker2);
  });
  infowindow2.open(map, marker2);

  marker3 = new google.maps.Marker({
     position: uluru3,
     map: map,
     title:  $info3
   });
   marker3.addListener('click', function() {
    infowindow3.open(map, marker3);
  });
  infowindow3.open(map, marker3);

   var mapStyle = [{
             'featureType': 'all',
             'elementType': 'all',
             'stylers': [{'visibility': 'on'}]
           }, {
             'featureType': 'landscape',
             'elementType': 'geometry',
             'stylers': [{'visibility': 'on'}, {'color': '#fcfcfc'}]
           }, {
             'featureType': 'water',
             'elementType': 'labels',
             'stylers': [{'visibility': 'on'}]
           }, {
             'featureType': 'water',
             'elementType': 'geometry',
             'stylers': [{'visibility': 'on'}, {'hue': '#5f94ff'}, {'lightness': 60}]
           }];
 };

 function calcRoute() {

   var partenza = document.getElementById("partenza").value;
   var arrivo = 'Via della Magliana, 183, 00146 Roma';
   var request = {
       origin:partenza, 
       destination:arrivo,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
   };
   directionsService.route(request, function(response, status) {
     if (status == google.maps.DirectionsStatus.OK) {
       directionsDisplay.setDirections(response);
     }
   });
 };



 document.getElementById("submitMappa").onclick = function() {
  calcRoute();
  marker.setMap(null);
  marker2.setMap(null);
  marker3.setMap(null);
  var offset = $("#right-panel").offset(); // Contains .top and .left
  offset.top -= 250;
  $('html, body').animate({
      scrollTop: offset.top,
      scrollLeft: offset.left
  });
 }