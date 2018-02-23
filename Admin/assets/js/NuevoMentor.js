/*Validations*/
$( document ).ready(function() {
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El maximo permitido son 5mb.');
	$("#NuevoMentor").validate({
                  errorPlacement: function(error, element) {
                    error.appendTo('#errordiv');
                  },
                  rules: {
                      "Nombre":     {
                                      required :true
                                    },
                      "Area":     {
                                      required :true
                                    },
                      "Puesto":     {
                                      required :true
                                    },
                      "profileImage":{
                                      extension: "png|jpg|jpeg",
                                      filesize : 1048576
                                    }
                  },
                  messages: {
                      "Nombre":     {
                                      required :"El nombre es requerido."
                                    },
                      "Area":     {
                                      required :"El área de especialización es requerida."
                                    },
                      "Puesto":     {
                                      required :"El puesto es requerido."
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
    var form = $( "#NuevoMentor" );
    if ($(form).valid()) {
      console.log('valido');
      addMentor(form);
    }else{
      console.log('no es valido');
    }
  });
});

function addMentor(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Mentor_c/addMentor',
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