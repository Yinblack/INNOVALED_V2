$( document ).ready(function() {
  loadJS('https://maps.googleapis.com/maps/api/js?key=AIzaSyAYkMddFBx2DO9pgrHW3PG1-bT5D4_V-WE&callback=initMap', () => {
  initMap();
  });
});


function initMap() {
if ($('#mapContainer').length) {
    var myLatLng = {lat: -12.079214, lng: -76.977405};
  // Specify features and elements to define styles.
  var styleArray = [
    {
      featureType: "all",
      stylers: [
       { saturation: -20 }
      ]
    },{
      featureType: "road.arterial",
      elementType: "geometry",
      stylers: [
        { hue: "#F5811F" },
        { saturation: -2500 }
      ]
    },{
      featureType: "poi.business",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
    }
  ];
  var image = window.base_url+'assets/img/web/iconMap.png';
  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map(document.getElementById('mapContainer'), {
    center: myLatLng,
    scrollwheel: false,
    styles: styleArray,
    zoom: 15
  });

  // Create a marker and set its position.
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    title: 'INNOVA LED.',
    icon: image
  });
}
}
