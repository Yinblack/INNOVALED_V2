/*Validations*/
$( document ).ready(function() {
	$("#Login").validate({
    rules: {
        "User":     {
                        required :true
                      },
        "Pass":     {
                        required :true
                      }
    },
    messages: {
        "User":     {
                        required :"Ingresa tu usuario o email."
                      },
        "Pass":     {
                        required :"Ingresa tu Contraseña."
                      }
    }
	});
});

$(function() {
  $('button#BtnLogin').click(function() {
    var form = $( "#Login" );
    if ($(form).valid()) {
      console.log('valido');
      Login(form);
    }else{
      console.log('no es valido');
    }
  });
});

function Login(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Persona_c/Login',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success'){
            notification('Inicio de sesión <strong>Correcto!</strong>','success','topRight');
            setTimeout(function() {   //calls click event after a certain time
              location.reload();
            }, 350);
          }else{
            notification('Usuario o contraseña incorrectos','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}