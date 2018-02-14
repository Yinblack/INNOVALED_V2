$("button#send").click(function(e){
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
    rules: {
      "Nombre":     {
      required :true
      },
      "Email":     {
      required :true,
      email: true
      }
    },
    messages: {
      "Nombre":     {
      required :"Este campo es obligatorio."
      },
      "Email":     {
      required :"Este campo es obligatorio.",
      email :"El Email no es valido."
      }
    }
  });
});

function send(form){
  var formData = new FormData($(form)[0]);
  $.ajax({
      url: window.base_url+'assets/library/EnviarCorreo.php',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(){
        console.log('Procesando');
        $('section#contacto div.formload').show();
        $("button#send").prop('disabled', true);
      },
      success: function(data){
        $(form)[0].reset();
        if (data=='success') {
          $('section#contacto div.formload div.estatus').removeClass('loading');
          setTimeout(function()
          {
            $('section#contacto div.formload').hide();
            $("button#send").prop('disabled', false);
          }, 2500);
        }else if(data=='error'){
          console.log(data);
        }
        console.log(data);
      },
      error: function(data){
        console.log('error ajax');
      }
  });
}