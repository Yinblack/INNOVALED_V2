/*Validations*/
$( document ).ready(function() {
	$("#Impuesto").validate({
    rules: {
        "Impuesto":     {
                        required :true,
                        number: true,
                        max: 100,
                        min: 0
                      }
    },
    messages: {
        "Impuesto":     {
                        required :"Ingrese un porcentaje.",
                        number :"El porcentaje debe de ser numerico.",
                        max:"El porcentaje debe de ser entre 0 y 100.",
                        min:"El porcentaje debe de ser entre 0 y 100."
                      }
    }
	});

  $("#correosCotizacion").validate({
    rules: {
      "Correo1":     {
                      email: true
                    },
      "Correo2":     {
                      email: true
      },
      "Correo3":     {
                      email: true
                    },
      "Correo4":     {
                      email: true
      },
      "Correo5":     {
                      email: true
                    }
    },
    messages: {
      "Correo1":     {
                      email :"No es un correo valido."
                    },
      "Correo2":     {
                      email :"No es un correo valido."
                    },
      "Correo3":     {
                      email :"No es un correo valido."
                    },
      "Correo4":     {
                      email :"No es un correo valido."
                    },
      "Correo5":     {
                      email :"No es un correo valido."
                    }
    }
	});

});

$(function() {
  $('button#btnUpdateImpuesto').click(function() {
    var form = $( "#Impuesto" );
    if ($(form).valid()) {
      console.log('valido');
      updateImpuesto(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateImpuesto(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Configuracion_c/updateImpuesto',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Modificando','info','topRight');
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success'){
            notification('Impuesto modificado <strong>correctamente.</strong>','success','topRight');
          }else{
            notification('Problema al modificar impuesto','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}


$(function() {
  $('button#btnUpdateCorreos').click(function() {
    var form = $( "#correosCotizacion" );
    if ($(form).valid()) {
      console.log('valido');
      updateCorreosCotizacion(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateCorreosCotizacion(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Configuracion_c/updateCorreosCotizacion',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Agregando','info','topRight');
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success'){
            notification('Correos guardados <strong>correctamente.</strong>','success','topRight');
          }else{
            notification('Problema al modificar correo','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}
