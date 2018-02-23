/*Validations*/
$( document ).ready(function() {
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El maximo permitido son 5mb.');
  $("#NuevoUsuario").validate({
                  rules: {
                      "Nombre":     {
                                      required :true
                                    },
                      "Email":     {
                                      required :true,
                                      email: true
                                    },
                      "Contrasena": {
                                      required :true,
                                      minlength :6
                                    },
                      "Contrasena2":     {
                                      equalTo: "#Contrasena",
                                      minlength :6
                                    }
                  },
                  messages: {
                      "Nombre":     {
                                      required :"El nombre es requerido."
                                    },
                      "Email":     {
                                      required :"El email es requerido.",
                                      email :"El email no es valido."
                                    },
                      "Contrasena": {
                                      required :"Llene ambos campos de contraseñas",
                                      minlength :"6 Digitos como minimo."
                                    },
                      "Contrasena2":{
                                      equalTo: "Las contraseñas no coinciden",
                                      minlength :"6 Digitos como minimo."
                                    }
                  }
  });
});

$(function() {
  $('button#formProcess').click(function() {
    var form = $( "#NuevoUsuario" );
    if ($(form).valid()) {
      console.log('valido');
      addUsuario(form);
    }else{
      console.log('no es valido');
    }
  });
});

function addUsuario(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Persona_c/addUsuario',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success') {
            notification('Usuario agregado','success','topRight');
            $(form)[0].reset();
          }else if (data=='emailOcupado') {
            notification('El Email ya esta ocupado','warning','topRight');
          }else{
            notification('Problema al agregar','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}