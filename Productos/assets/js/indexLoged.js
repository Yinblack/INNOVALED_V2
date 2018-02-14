/*Validations*/
$( document ).ready(function() {

  $("#updateNombre").validate({
    rules: {
        "Nombre":{
                  required: true
                }
    },
    messages: {
        "Nombre":{
                  required :"El nombre es obligatorio."
                }
    }
  });

  $("#updateContacto").validate({
    rules: {
        "Email":{
                  email: true
                },
        "Cp":{
                  number :true,
                  rangelength: [5, 5]
                }
    },
    messages: {
        "Email":{
                  email :"El email no es valido."
                },
        "Cp":{
                  number :"El Codigo Postal no es valido",
                  rangelength :"El Codigo Postal no es valido"
                }
    }
  });

  $("#updateUsuario").validate({
    rules: {
        "Usuario":{
                    minlength: 6
                  }
    },
    messages: {
        "Usuario":{
                    minlength :"6 Digitos como minimo."
                  }
    }
  });


});

$(function() {
  $('button.saveModal').click(function() {
    var form = this.closest("form");
    var dataFunction=$(form).attr('dataFunction');
    if ($(form).valid()) {
      console.log('valido');
      updateUsuario(form, dataFunction);
    }else{
      console.log('no es valido');
    }
  });
});



function updateUsuario(form, dataFunction){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Persona_c/'+dataFunction,
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
          }else{
            notification('Problema al modificar','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}