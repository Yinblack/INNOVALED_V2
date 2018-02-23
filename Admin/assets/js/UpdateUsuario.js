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
                      "Email":     {
                                      required :true,
                                      email: true
                                    },
                      "Usuario":     {
                                      minlength :6
                                    },
                      "Contrasena": {
                                      required :true
                                    },
                      "Contrasena2":     {
                                      equalTo: "#Contrasena"
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
                      "Email":     {
                                      required :"El email es requerido.",
                                      email :"El email no es valido."
                                    },
                      "Usuario":     {
                                      minlength :"6 Digitos como minimo."
                                    },
                      "Contrasena": {
                                      required :"Llene ambos campos de contraseñas"
                                    },
                      "Contrasena2":{
                                      equalTo: "Las contraseñas no coinciden"
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
      updateUsuario(form);
    }else{
      console.log('no es valido');
    }
  });
});

$("#TipoUser").on('change', function() {
    if ($(this).val() == 'Administrador'){
        $('.inputCliente').hide();
    }else if($(this).val() == 'SuperAdministrador') {
        $('.inputCliente').hide();
    }else{
        $('.inputCliente').show();
    }
});

$('input[type=radio][name=app-pass]').change(function() {
    if (this.value == 'hide') {
        $('div#changePass').hide();
    }else{
        $('div#changePass').show();
    }
});

$('input[type=radio][name=app-image]').change(function() {
    if (this.value == 'hide') {
        $('div#changeImage').hide();
    }else{
        $('div#changeImage').show();
    }
});

function updateUsuario(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Persona_c/updateUsuario',
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
            notification('Usuario modificado','success','topRight');
            resetInputsPassImage();
          }else if(data=='success and refresh'){
            notification('Usuario modificado','success','topRight');
            setTimeout(function(){ 
              location.reload(); 
            }, 300);
          }else{
            notification('Problema al modificar','error','topRight');
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

window.addEventListener("load", function () {
    window.loaded = true;
});

(function listen () {
    if (window.loaded) {
      if ($('select#TipoUser').val() == 'Administrador' || $('select#TipoUser').val() == 'SuperAdministrador' || $('select#TipoUser').val() == 'Duw Goruchaf'){
          $('.inputCliente').hide();
      } else {
          $('.inputCliente').show();
      }
    }else{
        window.setTimeout(listen, 50);
    }
})();

function resetInputsPassImage(){
  $('div#changePass').hide();
  $('div#changeImage').hide();
  $('input#Contrasena').val("");
  $('input#Contrasena2').val("");
  $('input#profileImage').val("");

  $("input.default").prop("checked", true);

}