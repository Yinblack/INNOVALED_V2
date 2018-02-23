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
      updateMentor(form);
    }else{
      console.log('no es valido');
    }
  });
});

$('input[type=radio][name=app-image]').change(function() {
    if (this.value == 'hide') {
        $('div#changeImage').hide();
    }else{
        $('div#changeImage').show();
    }
});

function updateMentor(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Mentor_c/updateMentor',
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
            notification('Mentor modificado','success','topRight');
            resetInputsPassImage();
          }else if(data=='success and refresh'){
            notification('Mentor modificado','success','topRight');
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

function resetInputsPassImage(){
  $('div#changeImage').hide();
  $('input#profileImage').val("");
  $("input.default").prop("checked", true);

}