/*Validations*/
$( document ).ready(function() {
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El archivo debe de ser menor a {0}');
	$("#profile_config").validate({
    rules: {
        "Nombre":     {
                        required :true
                      },
        "Usuario":     {
                        required :true,
                        maxlength: 16,
                        minlength: 6
                      },
        "password1":     {
                        maxlength: 20,
                        minlength: 6
                      },
        "password2":     {
                        maxlength: 20,
                        minlength: 6,
                        equalTo: "#password1"
                      }
    },
    messages: {
        "Nombre":     {
                        required :"Agregue su nombre."
                      },
        "Usuario":     {
                        required :"Agregue su nombre.",
                        maxlength :"El usuario debe de contener entre 6 y 16 caracteres.",
                        minlength :"El usuario debe de contener entre 6 y 16 caracteres."
                      },
        "password1":     {
                        maxlength :"La contraseña debe de contener entre 6 y 20 caracteres.",
                        minlength :"La contraseña debe de contener entre 6 y 20 caracteres."
                      },
        "password2":     {
                        maxlength :"La contraseña debe de contener entre 6 y 20 caracteres.",
                        minlength :"La contraseña debe de contener entre 6 y 20 caracteres.",
                        equalTo: "Las contraseñas no coinciden"
                      }
    }
	});
});

$(function() {
  $('button#formProcess').click(function() {
    var form = $( "#profile_config" );
    if ($(form).valid()) {
      console.log('valido');
      updateProfile(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateProfile(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Persona_c/updateProfile',
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
            notification('Perfil modificado <strong>correctamente.</strong>','success','topRight');
            setTimeout(function() {
              location.reload();
            }, 350);          
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