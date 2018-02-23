Conekta.setPublishableKey(window.public_key);
Conekta.setLanguage("es");

/*Validations*/
$( document ).ready(function() {
  $("#DatosPago").validate({
    errorPlacement: function(error, element) {
      var name = $(element).attr("name");
      if (name=='Mes') {
        $('div.errorMes').html(error);
      }else if (name=='Anio') {
        $('div.errorAnio').html(error);
      }else{
        element.next('div.error').html(error);
      }
    },
    rules: {
        "Nombre":     {
                        required :true
                      },
        "NoTarjeta":     {
                        required :true,
                        creditcard: true
                      },
        "Codigo": {
                        required :true,
                        rangelength: [3, 4],
                        number: true
                      },
        "Mes": {
                        required :true
                      },
        "Anio": {
                        required :true
                      }
    },
    messages: {
        "Nombre":     {
                        required :"El Nombre es requerido."
                      },
        "NoTarjeta":     {
                        required :"El Numero de Tarjeta es requerido.",
                        creditcard :"El numero de tarjeta no es valido."
                      },
        "Codigo": {
                        required :"El Codigo es requerido.",
                        rangelength :"El Codigo no es valido.",
                        rangelength :"El Codigo no es valido."
                      },
        "Mes": {
                        required :"El Mes es requerido."
                      },
        "Anio": {
                        required :"El Año es requerido."
                      }
    }
  });

  $('#NoTarjeta').change(function() {
        var type=Conekta.card.getBrand($(this).val());
        $('label#typeCard').empty();
        $('label#typeCard').html(type);
        console.log('changed');
  });

});


$(function() {
  $('button#PayFree').click(function() {
    var formData = new FormData();
    formData.append('idCodeEvt', $('input#idCodeEvt').val());
    $.ajax({
        url: window.base_url+'Inscripcion_c/addInscripcionFree',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
          swal({
            title: "Procesando",
            text: "No cierre la ventana mientras se completa la inscripción.",
            showConfirmButton: false
          });
        },
        success: function(data){
          console.log(data);
          if (data=='success') {
            swal({
              title: "Inscripción registrada",
              showConfirmButton: true,
              type: "success",
              confirmButtonText: "Ok"
            },
            function(){
              window.location.href = 'ListEventosInscrito';
            }
            );
          }else{
            swal({
              title: "No se pudo completar el registro",
              showConfirmButton: true,
              type: "error",
              confirmButtonText: "Ok"
            });
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });


  });
});


$(function() {
  $('button#Pay').click(function() {
    var form = $( "#DatosPago" );
    if ($(form).valid()) {
      pay(form);
    }else{
      console.log('no es valido');
    }
  });
});

function pay(){
  var Nombre=$('#Nombre').val();
  var NoTarjeta=$('#NoTarjeta').val();
  var TypeTarjeta=$('#TypeTarjeta').val();
  var Codigo=$('#Codigo').val();
  var Mes=$('#Mes').val();
  var Anio=$('#Anio').val();

  var tokenParams = {
    "card": {
      "number": NoTarjeta,
      "name": Nombre,
      "exp_year": Anio,
      "exp_month": Mes,
      "cvc": Codigo
    }
  };
  Conekta.token.create(tokenParams, successResponseHandler, errorResponseHandler);
}

var successResponseHandler = function(token) {
  var jsonArray = JSON.stringify(token);
  var formData = new FormData();
  $.each( token, function( key, value ) {
    formData.append(key, value);
  });

  formData.append('idCodeEvt', $('input#idCodeEvt').val());
  formData.append('Nombre', $('input#Nombre').val());

  $.ajax({
      url: window.base_url+'Inscripcion_c/addInscripcion',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(){
        console.log('Procesando');
        swal({
          title: "Procesando",
          text: "No cierre la ventana mientras se completa el pago.",
          showConfirmButton: false
        });
      },
      success: function(data){
        console.log(data);
        if (data=='success') {
          swal({
            title: "Pago completado",
            showConfirmButton: true,
            type: "success",
            confirmButtonText: "Ok"
          },
          function(){
            window.location.href = 'ListEventosInscrito';
          }
          );
        }else{
          swal({
            title: "No se pudo completar el pago",
            showConfirmButton: true,
            type: "error",
            confirmButtonText: "Ok"
          });
        }
      },
      error: function(data){
        console.log('Error Ajax Peticion');
        console.log(data);
      }
  });
};

var errorResponseHandler = function(error){
  console.log('error');
};