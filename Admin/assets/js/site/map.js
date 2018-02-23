$( document ).ready(function() {
  loadJS('https://maps.googleapis.com/maps/api/js?key=AIzaSyAYkMddFBx2DO9pgrHW3PG1-bT5D4_V-WE&callback=initMap', () => {
  initMap();
  });
});


function initMap() {
  if ($('#mapContainer').length) {
    var myLatLng = {lat: -12.079214, lng: -76.977405};
    var position = {lat: -12.079214, lng: -76.978705};
    var map = new google.maps.Map(document.getElementById('mapContainer'), {
      center: position,
      scrollwheel: false,
      zoom: 17
    });
    var marker = new google.maps.Marker({
      map: map,
      position: myLatLng,
      title: 'INNOVA LED.'
    });
  }
}