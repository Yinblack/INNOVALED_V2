/*Validations*/
$( document ).ready(function() {
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El maximo permitido son 5mb.');
	$("#NuevoUsuario").validate({
                  errorPlacement: function(error, element) {
                    error.appendTo('#errordiv');
                  },
                  rules: {
                      "TipoUser":     {
                                      required :true
                                    },
                      "Nombre":     {
                                      required :true
                                    },
                      "ApePaterno":     {
                                      required :true
                                    },
                      "ApeMaterno":     {
                                      required :true
                                    },
                      "Telefono":     {
                                      required :true
                                    },
                      "Celular":     {
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
                                    },
                      "profileImage":{
                                      extension: "png|jpg|jpeg",
                                      filesize : 1048576
                                    }
                  },
                  messages: {
                      "TipoUser":     {
                                      required :"Seleccione un nivel de usuario."
                                    },
                      "Nombre":     {
                                      required :"El nombre es requerido."
                                    },
                      "ApePaterno":     {
                                      required :"El apellido paterno es requerido."
                                    },
                      "ApeMaterno":     {
                                      required :"El apellido materno es requerido."
                                    },
                      "Telefono":     {
                                      required :"El telefono es requerido."
                                    },
                      "Celular":     {
                                      required :"El celular es requerido."
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
                                    },
                      "profileImage":{
                                      extension:"La imagen de perfil tiene una extension no valida",
                                      filesize :"La imagen de perfil Excede el peso maximo"
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

$("#TipoUser").on('change', function() {
    if ($(this).val() == 'Administrador'){
        $('.inputCliente').hide();
    } else {
        $('.inputCliente').show();
    }
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
          }else{
            notification('Problema al agregar','error','topRight');
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}