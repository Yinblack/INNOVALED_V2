$( document ).ready(function() {
  $('.modal-options').iziModal({
    headerColor: '#030463',
    width: '50%',
    overlayColor: 'rgba(0, 0, 0, 0.5)',
    fullscreen: true,
    transitionIn: 'fadeInUp',
    transitionOut: 'fadeOutDown'
  });
  $('.beforeSend').iziModal({
    headerColor: '#030463',
    width: 400,
    timeout: 10000,
    pauseOnHover: true,
    timeoutProgressbar: true,
    attached: 'bottom'
  });

  $("form#cotizacionServicio").validate({
    errorPlacement: function(error, element) {
        error.appendTo('#errorlog');
    },
    rules: {
      "proyecto":     {
      required :true
      },
      "tipoPantalla":     {
      required :true
      },
      "ambiente":     {
      required :true
      },
      "largo":     {
      required :true
      },
      "ancho":     {
      required :true
      },
      "calidad":     {
      required :true
      },
      "nombre":     {
      required :true
      },
      "correo":     {
      require_from_group: [1, ".group"],
      email: true
      },
      "telefono":     {
      require_from_group: [1, ".group"],
      number: true,
      maxlength: 16,
      minlength: 8
      }
    },
    messages: {
      "proyecto":     {
      required :"Seleccione un producto."
      },
      "tipoPantalla":     {
      required :"Seleccione un tipo de pantalla."
      },
      "ambiente":     {
      required :"Seleccione un ambiente."
      },
      "largo":     {
      required :"Ingrese el largo."
      },
      "ancho":     {
      required :"Ingrese el ancho."
      },
      "calidad":     {
      required :"Ingrese la calidad de imagen."
      },
      "nombre":     {
      required :"Ingrese su nombre."
      },
      "correo":     {
      require_from_group :"Complete uno de los campos correo o telefono.",
      email :"El Email no es valido."
      },
      "telefono":     {
      require_from_group :"Complete uno de los campos correo o telefono.",
      number:"Numero de telefono no valido",
      maxlength:"Numero de telefono demasiado largo",
      minlength:"Numero de telefono demasiado corto"
      }
    }
  });
});




$("a#btnCotizarServicio").click(function(e){
  e.preventDefault();
  var form=$("form#cotizacionServicio");
  if ($(form).valid()) {
    console.log('valido');
    sendCotizacionServicio(form);
  }else{
    console.log('no es valido :D');
  }
});

function sendCotizacionServicio(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Cart_c/sendCotizacionServicio',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
          $('.beforeSend').iziModal('open');
        },
        success: function(data){
          if (data=='success') {
            $('.beforeSend').iziModal('close');
            $('.modal-options').iziModal('open');
            $(form)[0].reset();
            setTimeout(function()
            {
              $('.modal-options').iziModal('close');
            }, 5000);
          }else{
            console.log('error');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}
