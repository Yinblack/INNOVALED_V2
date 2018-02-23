/*Validations*/
$( document ).ready(function() {
  var itemsDeleted;
  window.itemsDeleted='';
  var counterAds;
  window.counterAds=1;

  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'El archivo debe de ser menor a {0}');
  $("#NuevoProducto").validate({
    rules: {
        "Nombre":     {
                        required :true,
                        maxlength: 100
                      },
        "Descripcion":     {
                        maxlength: 500
                      },
        "Linea":     {
                        required :true
                      },
        "SubLinea":     {
                        required :true
                      },
        "Marca":     {
                        required :true
                      },
        "Precio":     {
                        required :true,
                        number: true,
                        maxlength: 5
                      },
        "Mostrar":     {
                        required :true
                      },
        "Moneda":     {
                        required :true
                      },
        "Show":     {
                        required :true
                      },
        "Orden":     {
                        required :true,
                        number: true,
                        maxlength: 5
                      },
        "Imagen1":     {
                        required: true,
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      },
        "Imagen2":     {
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      },
        "Imagen3":     {
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      },
        "Imagen4":     {
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      },
        "Imagen5":     {
                        extension: "jpg|jpeg|png",
                        filesize: 307200
                      },
        "FichaTecnica":{
                        extension: "pdf",
                        filesize: 5242880
                      }
    },
    messages: {
        "Nombre":     {
                        required :"Nombre: requiere ser llenado.",
                        maxlength :"Nombre: El maximo permitido son 100 caracteres."
                      },
        "Descripcion":     {
                        maxlength :"Descripcion: El maximo permitido son 500 caracteres."
                      },
        "Linea":     {
                        required :"Linea: requiere ser llenado."
                      },
        "SubLinea":     {
                        required :"SubLinea: requiere ser llenado."
                      },
        "Marca":     {
                        required :"Marca: requiere ser llenado."
                      },
        "Precio":     {
                        required :"Precio: requiere ser llenado.",
                        number :"Precio: Se requiere un valor numerico.",
                        maxlength :"Precio: El maximo permitido son 5 caracteres."
                      },
        "Mostrar":     {
                        required :"Moneda: Seleccione una opción."
                      },
        "Moneda":     {
                        required :"Moneda: Seleccione una opción."
                      },
        "Show":     {
                        required :"Mostrar precio: Seleccione una opción."
                      },
        "Orden":     {
                        required :"Orden: requiere ser llenado.",
                        number :"Orden: Se requiere un valor numerico.",
                        maxlength :"Orden: El maximo permitido son 5 caracteres."
                      },
        "Imagen1":     {
                        required :"La imagen 1 es obligatoria",
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      },
        "Imagen2":     {
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      },
        "Imagen3":     {
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      },
        "Imagen4":     {
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      },
        "Imagen5":     {
                        extension :"Solo ase aceptan imagenes en formato jpg, jpeg y png",
                        filesize :"La imagen excede el maximo permitido de 300 kb."
                      },
        "FichaTecnica":{
                        extension :"El archivo debe tener la extension .pdf",
                        filesize :"La ficha tecnica excede el maximo permitido de 5Mb."
                      }
    }
  });
});

$('input[type=radio][name=1]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput1').hide();
    }else{
        $('div.imageInput1').show();
    }
});
$('input[type=radio][name=2]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput2').hide();
    }else{
        $('div.imageInput2').show();
    }
});
$('input[type=radio][name=3]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput3').hide();
    }else{
        $('div.imageInput3').show();
    }
});
$('input[type=radio][name=4]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput4').hide();
    }else{
        $('div.imageInput4').show();
    }
});
$('input[type=radio][name=5]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput5').hide();
    }else{
        $('div.imageInput5').show();
    }
});
$('input[type=radio][name=6]').change(function() {
    if (this.value == 'hide') {
        $('div.imageInput6').hide();
    }else{
        $('div.imageInput6').show();
    }
});

$("select#Linea").change(function(){
    var IdLinea=$(this).val();

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
          $("select#SubLinea").empty();
        },
        success: function(data){
          if (data=='Nan') {
            $("select#SubLinea").append($('<option>', {
                value: '',
                text: "La linea seleccionada no tiene sublineas"
            }));
          }else{
            var jsonObj=JSON.parse(data);
            for (var i = jsonObj.length - 1; i >= 0; i--) {
              var IdSubLinea=jsonObj[i]['IdSubLinea'];
              var Etiqueta=jsonObj[i]['Etiqueta'];
              $("select#SubLinea").append($('<option>', {
                  value: IdSubLinea,
                  text: Etiqueta
              }));
            }
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
        }
    });
});


$(function() {
  $('button#formProcess').click(function() {
    var form = $( "#UpdateProducto" );
    if ($(form).valid()) {
      console.log('valido');
      updateProducto(form);
    }else{
      console.log('no es valido');
    }
  });
});

function updateProducto(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/updateProducto',
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
            notification('Producto modificado <strong>correctamente.</strong>','success','topRight');
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

if ($("input#row_cnt").length) {
  var row_cnt=$("input#row_cnt").val();
}else{
  var row_cnt=0;
}
var items = [];
var counter=0;
for (var i=row_cnt; i <= 100; i++) {
    var val=i+1;
    items[counter] =val;
    counter++;
}

$(function() {
  $('button#addItem').click(function() {
    var smallVal=Math.min.apply( Math, items );
    $('<div class="col-xs-12 nopadding itemToList" dataNoItem="'+smallVal+'"><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Titulo *</span><input type="text" class="form-control" name="Titulo'+smallVal+'" id="Titulo'+smallVal+'" required="true" data-msg-required="Agregue un titulo a la lista"></div></div><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Valor *</span><input type="text" class="form-control" name="Valor'+smallVal+'" id="Valor'+smallVal+'" required="true" data-msg-required="Agregue un texto a la lista"></div></div><button type="button" onclick="deleteItem('+smallVal+')" class="btn btn-default btn-icon"><span class="icon-circle-minus"></span></button></div>').appendTo('div#List');
    var index = items.indexOf(smallVal);
    items.splice(index, 1);
  });
});


function deleteItem(id){
  if ($('div[datanoitem='+id+']').hasClass('fixed')) {
    var IdCarac=$('div[datanoitem='+id+']').attr('IdCarecterisctica');
    $('<input type="hidden" name="deleteItem'+window.counterAds+'" value="'+IdCarac+'" />').appendTo('form#UpdateProducto');
    window.counterAds++;
  }
  $('div[datanoitem='+id+']').remove();
  console.log('removed');
}
