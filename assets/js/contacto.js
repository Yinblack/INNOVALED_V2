function initMap() {
  console.log('run function');
  var myLatLng = {lat: -12.079214, lng: -76.977405};
  var myLatCenter = {lat: -12.079214, lng: -76.981405};
  var styleArray = [
              {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
              {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
              {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
              {
                featureType: 'administrative',
                elementType: 'geometry.stroke',
                stylers: [{color: '#c9b2a6'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'geometry.stroke',
                stylers: [{color: '#dcd2be'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#ae9e90'}]
              },
              {
                featureType: 'landscape.natural',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#93817c'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry.fill',
                stylers: [{color: '#a5b076'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#447530'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
              },
              {
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [{color: '#fdfcf8'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#f8c967'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e9bc62'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry',
                stylers: [{color: '#e98d58'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry.stroke',
                stylers: [{color: '#db8555'}]
              },
              {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#806b63'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.fill',
                stylers: [{color: '#8f7d77'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#ebe3cd'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [{color: '#b9d3c2'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#92998d'}]
              }
          ];
  var image = {
      url: window.base_url+'../assets/img/location.png',
  };
  var map = new google.maps.Map(document.getElementById("map"), {
    center: myLatCenter,
    scrollwheel: false,
    styles: styleArray,
    zoom: 16
  });
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    title: 'INNOVALED PERÚ',
    icon: image
  });
  console.log('map created');
}

$("a#btnEnviar").click(function(e){
  e.preventDefault();
  var form = $('form#contacto');
  if ($(form).valid()) {
    console.log('valido');
    send(form);
  }else{
    console.log('no es valido');
  }
});
$( document ).ready(function() {
  $("form#contacto").validate({
    errorElement : 'span',
    rules: {
      "nombre":     {
      required :true
      },
      "correo":     {
      required :true,
      email: true
      },
      "telefono":     {
      required :true
      }
    },
    messages: {
      "nombre":     {
      required :"Este campo es requerido."
      },
      "correo":     {
      required :"Este campo es requerido.",
      email :"El correo electronico no es valido."
      },
      "telefono":     {
      required :"Este campo es requerido."
      }
    }
  });
});

function send(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'../assets/library/EnviarCorreo.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
          $('div#status').removeClass('loading success error');
          $('div#status').addClass('loading');
          $('div#status').slideDown(500);
          $("a#sendContacto").prop('disabled', true);
        },
        success: function(data){
          $(form)[0].reset();
          if (data=='success') {
            $('div#status').removeClass('loading success error');
            $('div#status').addClass('success');
            $("a#sendContacto").prop('disabled', false);
            setTimeout(function()
            {
              $('div#status').slideUp(500);
            }, 2500);
          }
          console.log(data);
        },
        error: function(data){
          $('div#status').removeClass('loading success error');
          $('div#status').addClass('error');
          $("a#sendContacto").prop('disabled', false);
          setTimeout(function()
          {
            $('div#status').slideUp(500);
          }, 2500);
        }
    });
}