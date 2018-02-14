/*Validations*/
$( document ).ready(function() {
	$("#NuevoUsuario").validate({
    errorPlacement: function(error, element) {
      error.appendTo('#errordiv');
    },
    rules: {
        "Titulo":     {
                        required :true,
                        maxlength: 100
                      },
        "Descripcion":     {
                        maxlength: 500
                      },
        "Lugar":     {
                        required :true,
                        maxlength: 50
                      },
        "Fecha":     {
                        required :true,
                        maxlength: 50
                      },
        "Hora":     {
                        required :true,
                        maxlength: 50
                      },
        "Cupo":     {
                        number :true,
                        maxlength: 5
                      },
        "Precio":     {
                        number :true,
                        maxlength: 5
                      }
    },
    messages: {
        "Titulo":     {
                        required :"Titulo: requiere ser llenado.",
                        maxlength :"Titulo: El maximo permitido son 100 caracteres."
                      },
        "Descripcion":     {
                        maxlength :"Titulo: El maximo permitido son 500 caracteres."
                      },
        "Lugar":     {
                        required :"Lugar: requiere ser llenado.",
                        maxlength :"Lugar: El maximo permitido son 50 caracteres."
                      },
        "Fecha":     {
                        required :"Fecha: requiere ser llenado.",
                        maxlength :"Fecha: El maximo permitido son 50 caracteres."
                      },
        "Hora":     {
                        required :"Hora: requiere ser llenado.",
                        maxlength :"Hora: El maximo permitido son 50 caracteres."
                      },
        "Cupo":     {
                        number :"Cupo: Se requiere un valor numerico.",
                        maxlength :"Cupo: El maximo permitido son 5 caracteres."
                      },
        "Precio":     {
                        number :"Precio: Se requiere un valor numerico.",
                        maxlength :"Precio: El maximo permitido son 5 caracteres."
                      }
    }
	});
});

$(function() {
  $('button#formProcess').click(function() {
    var form = $( "#NuevoUsuario" );
    if ($(form).valid()) {
      console.log('valido');
      addEvento(form);
    }else{
      console.log('no es valido');
    }
  });
});

function addEvento(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Evento_c/addEvento',
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
            notification('Evento agregado <strong>correctamente!</strong>','success','topRight');
            $(form)[0].reset();
            setTimeout(function(){ window.location.href = 'ListEventos'; }, 2000);
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

var items = [];
for (var i=0; i <= 100; i++) {
  var val=i+1;
  items[i] =val;
}

$(function() {
  $('button#addItem').click(function() {
    var smallVal=Math.min.apply( Math, items );
    $('<div class="col-xs-12 nopadding itemToList" dataNoItem="'+smallVal+'"><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Titulo *</span><input type="text" class="form-control" name="Titulo'+smallVal+'" id="Titulo'+smallVal+'" required="true" data-msg-required="Agregue un titulo a la lista"></div></div><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Información *</span><input type="text" class="form-control" name="Informacion'+smallVal+'" id="Informacion'+smallVal+'" required="true" data-msg-required="Agregue un texto a la lista"></div></div><button type="button" onclick="deleteItem('+smallVal+')" class="btn btn-default btn-icon"><span class="icon-circle-minus"></span></button></div>').appendTo('div#List');
    var index = items.indexOf(smallVal);
    items.splice(index, 1);
  });
});

function deleteItem(id){
  $('div[datanoitem='+id+']').remove();
  console.log('removed');
}