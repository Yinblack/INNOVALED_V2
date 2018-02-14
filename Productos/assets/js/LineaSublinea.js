$(document).ready(function() {
    $('.data-simple').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

/*Validations*/
$( document ).ready(function() {
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El archivo debe de ser menor a {0}');
  $("#addLinea").validate({
    rules: {
        "Etiqueta":     {
                        required :true
                      }
    },
    messages: {
        "Etiqueta":     {
                        required :"Este campo es obligatorio."
                      }
    }
  });
  $("#updateLinea").validate({
    rules: {
        "Etiqueta":     {
                        required :true
                      }
    },
    messages: {
        "Etiqueta":     {
                        required :"Este campo es obligatorio."
                      }
    }
  });
  $("#updateSubLinea").validate({
    rules: {
        "Etiqueta":     {
                        required :true
                      }
    },
    messages: {
        "Etiqueta":     {
                        required :"Este campo es obligatorio."
                      }
    }
  });
  $("#addSubLinea").validate({
    rules: {
        "Etiqueta":     {
                        required :true
                      },
        "Imagen":     {
                        required: true,
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      }
    },
    messages: {
        "Etiqueta":     {
                        required :"Este campo es obligatorio."
                      },
        "Imagen":     {
                        required :"La imagen es obligatoria",
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      }
    }
  });
});

/*DELETE LINEA*/
function deleteLinea(IdLinea){
	confirm('¿Seguro desea elimar la linea? se eliminaran las sublineas y productos relacionados.', deleteLineaFunction, IdLinea);
}
function deleteLineaFunction(IdLinea){
  var formData = new FormData();

    formData.append('IdLinea', IdLinea);

    $.ajax({
        url: window.base_url+'Producto_c/deleteLinea',
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
          	$('tr#'+IdLinea).remove();
            notification('Linea eliminada <strong>correctamente!</strong>','success','topRight');
          }else{
            notification('No puede eliminar la Linea, esta siendo ocupada por productos.','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

/*DELETE SUBLINEA*/
function deleteSubLinea(IdSubLinea){
  confirm('¿Seguro desea elimar la linea? se eliminaran las sublineas y productos relacionados.', deleteSubLineaFunction, IdSubLinea);
}
function deleteSubLineaFunction(IdSubLinea){
  var formData = new FormData();

    formData.append('IdSubLinea', IdSubLinea);

    $.ajax({
        url: window.base_url+'Producto_c/deleteSubLinea',
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
            notification('Sublinea eliminada <strong>correctamente!</strong>','success','topRight');
          }else{
            notification('No puede eliminar la sublinea, esta siendo ocupada por productos.','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

/*Agregar Sublinea*/
function showModalAddSublinea(IdLinea){
  $('form#addSubLinea input#IdLinea').val(IdLinea);
  $('#modal-add-sublinea').modal('show');
}

$(function() {
  $('button.addSubLinea').click(function() {
    var form = $( "#addSubLinea" );
    if ($(form).valid()) {
      console.log('valido');
      addSubLinea(form);
    }else{
      console.log('no es valido');
    }
  });
});

function addSubLinea(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/addSubLinea',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Agregando','info','topRight');
        },
        success: function(data){
          if (data=='success'){
            notification('Sublinea agregada <strong>correctamente.</strong>','success','topRight');
            $(form)[0].reset();
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

/*MOSTRAR SUBLINEAS EN TABLA*/
function showSublineas(IdLinea){
    var formData = new FormData();
    formData.append('IdLinea', IdLinea);
    $.ajax({
        url: window.base_url+'Producto_c/getSubLineasFromLinea',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $('tbody#sublineasContainer').empty();
        },
        success: function(data){
          if (data=='Nan') {
              $('<div class="col-xs-12 text-center">La linea no tiene sublineas</div>').appendTo('tbody#sublineasContainer');
          }else{
            var jsonObj=JSON.parse(data);
            for (var i = jsonObj.length - 1; i >= 0; i--) {
              var IdSubLinea=jsonObj[i]['IdSubLinea'];
              var Etiqueta=jsonObj[i]['Etiqueta'];
              var EtiquetaFix="'"+jsonObj[i]['Etiqueta']+"'";
              $('<tr id="'+IdSubLinea+'"><td>'+IdSubLinea+'</td><td>'+Etiqueta+'</td><td><a onclick="showModalUpdateSub('+IdSubLinea+','+EtiquetaFix+')"><button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button></a><a onclick="deleteSubLinea('+IdSubLinea+')"><button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button></a></td></tr>').appendTo('tbody#sublineasContainer');
            }
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
        }
    });
}

/*AGREGAR LINEA*/
$(function() {
  $('button.addLinea').click(function() {
    var form = $( "#addLinea" );
    if ($(form).valid()) {
      console.log('valido');
      addLinea(form);
    }else{
      console.log('no es valido');
    }
  });
});
function addLinea(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/addLinea',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Agregando','info','topRight');
        },
        success: function(data){
          if (data=='success'){
            notification('Linea agregada <strong>correctamente.</strong>','success','topRight');
            $(form)[0].reset();
            setTimeout(function(){ location.reload(); }, 2000);
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



/*UPDATE LINEA*/
function showModalUpdate(IdLinea, Etiqueta){
  console.log(IdLinea);
  console.log(Etiqueta);
  $('form#updateLinea input#IdLinea').val(IdLinea);
  $('form#updateLinea input#Etiqueta').val(Etiqueta);
  $('#modal-update-etiqueta').modal('show');
}

$(function() {
  $('button.updateLinea').click(function() {
    var form = $( "#updateLinea" );
    if ($(form).valid()) {
      console.log('valido');
      updateLinea(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateLinea(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/updateLinea',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Agregando','info','topRight');
        },
        success: function(data){
          if (data=='success'){
            notification('Linea modificada <strong>correctamente.</strong>','success','topRight');
            setTimeout(function(){ location.reload(); }, 2000);
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


/*UPDATE SUBLINEA*/
function showModalUpdateSub(IdSubLinea, Etiqueta){
  console.log(IdSubLinea);
  console.log(Etiqueta);
  $('body').find('input#IdSubLinea').attr('value', IdSubLinea);
  $('body').find('input#Etiqueta').attr('value', Etiqueta);
  $('img#containerImgSubLinea').attr('src','assets/img/Sublineas/'+IdSubLinea+'/img.png');
  $('#modal-update-sublinea').modal('show');
}

$(function() {
  $('button.updateSubLinea').click(function() {
    var form = $( "#updateSubLinea" );
    if ($(form).valid()) {
      console.log('valido');
      updateSubLinea(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateSubLinea(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/updateSubLinea',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          notification('Agregando','info','topRight');
        },
        success: function(data){
          if (data=='success'){
            notification('Sublinea modificada <strong>correctamente.</strong>','success','topRight');
            setTimeout(function(){ window.location.reload(true); }, 2000);
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
