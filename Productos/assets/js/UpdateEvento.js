/*Indexacion de array ArrayItemsDef*/
var arrayItemsDef;
window.arrayItemsDef = [];
/*Indexacion de array DeleteFefaults*/
var arrayItemsDelDef;
window.arrayItemsDelDef = [];
/*Indexacion de array arrayItems(Items por agregar)*/
var arrayItems;
window.arrayItems = [];
/*Indexacion de array arrayItemsAdded(Items agregados)*/
var arrayItemsAdded;
window.arrayItemsAdded = [];

/*Validations*/
$( document ).ready(function() {
	$("#Evento").validate({
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
    var form = $( "#Evento" );
    if ($(form).valid()) {
      updateEvento(form);
    }else{
      console.log('no es valido');
    }
  });
});

window.addEventListener("load", function () {
    window.loaded = true;
});

(function listen () {
    if (window.loaded) {
        /*ARRAY DE ITEMS POR AGREGAR MENOS ITEMS DEFAULT*/
        for (var i=0; i <= 10000; i++) {
          var val=i+1;
          window.arrayItems[i] =val;
        }
        $( "div.itemToList" ).each(function() {
          var item=$(this).attr("dataNoItem");
          item=parseInt(item);
          var index = window.arrayItems.indexOf(item);
          window.arrayItems.splice(index, 1);
        });
        /*ARRAY DE ITEMS DEFAULT*/
        var counterItemsDef;
        window.counterItemsDef = 0;
        $( "div.itemToList" ).each(function() {
          var def=$(this).attr("dataDefault");
          if (def=='si') {
            window.arrayItemsDef[window.counterItemsDef]=$(this).attr("dataId");
            window.counterItemsDef++;
          }
        });
    }else{
        window.setTimeout(listen, 50);
    }
})();

/*AGREGA HTML ITEM, LO ELIMINA DE ARRAY arrayItems, LO AGREGAR A ARRAY arrayItemsAdded*/
$(function() {
  $('button#addItem').click(function() {
    /**/
    var smallVal=Math.min.apply( Math, window.arrayItems );
    $('<div class="col-xs-12 nopadding itemToList" dataNoItem="'+smallVal+'" dataDefault="no"><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Titulo *</span><input type="text" class="form-control" name="Titulo'+smallVal+'" id="Titulo'+smallVal+'" required="true" data-msg-required="Agregue un titulo a la lista"></div></div><div class="col-xs-12 col-sm-6 nopadding"><div class="input-group"><span class="input-group-addon">Información *</span><input type="text" class="form-control" name="Informacion'+smallVal+'" id="Informacion'+smallVal+'" required="true" data-msg-required="Agregue un texto a la lista"></div></div><button type="button" onclick="deleteItem('+smallVal+')" class="btn btn-default btn-icon"><span class="icon-circle-minus"></span></button></div>').appendTo('div#List');
    /**/
    var index = window.arrayItems.indexOf(smallVal);
    window.arrayItems.splice(index, 1);
    /**/
    if (window.arrayItemsAdded.constructor !== Array) {
      window.arrayItemsAdded=[];
    }
    window.arrayItemsAdded.push(smallVal);

  });
});

/*ELIMINA HTML DE ITEM, AGREGAR A ARRAY arrayItemsDelDef Y ELIMINAR DE ARRAY arrayItemsDef*/
function deleteItem(id){
  var datadefault=$('div[datanoitem='+id+']').attr('datadefault');
  if (datadefault=='si'){
    var dataid=$('div[datanoitem='+id+']').attr('dataid');
    if (window.arrayItemsDelDef.constructor !== Array) {
      window.arrayItemsDelDef=[];
    }
    window.arrayItemsDelDef.push(dataid);
    var index = window.arrayItemsDef.indexOf(dataid);
    window.arrayItemsDef.splice(index, 1);
  }else{
    var index = window.arrayItemsAdded.indexOf(dataid);
    window.arrayItemsAdded.splice(index, 1);
  }
  $('div[datanoitem='+id+']').remove();
}

function updateEvento(form){
  var formData = new FormData($(form)[0]);
    
    arrayProcess();
    formData.append('toDelete', window.arrayItemsDelDef);
    formData.append('toUpdate', window.arrayItemsDef);
    formData.append('toCreate', window.arrayItemsAdded);

    $.ajax({
        url: window.base_url+'Evento_c/updateEvento',
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
            notification('Evento modificado <strong>correctamente!</strong>','success','topRight');
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

function  arrayProcess(){
    if (window.arrayItemsDef.length <= 0) {
      window.arrayItemsDef='EMPTY'
    }
    if (window.arrayItemsDelDef.length <= 0) {
      window.arrayItemsDelDef='EMPTY'
    }
    if (window.arrayItemsAdded.length <= 0) {
      window.arrayItemsAdded='EMPTY'
    }
    console.log('toDelete :  '+window.arrayItemsDelDef);
    console.log('toUpdate :  '+window.arrayItemsDef);
    console.log('toCreate :  '+window.arrayItemsAdded);
}








/*COPIA DE ListEventos.js PARTE DEL ELIMINAR con modificaciones de redireccion*/
function DeleteEvento(idEvt){
  confirm('¿Desea elimar el evento?', deleteEvento, idEvt);
}

function deleteEvento(idEvt){

  var formData = new FormData();
    
    formData.append('idEvt', idEvt);

    $.ajax({
        url: window.base_url+'Evento_c/deleteEvento',
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
            notification('Evento eliminado <strong>correctamente!</strong>','success','topRight');
            setTimeout(function(){ window.location.href = "ListEventos"; }, 300);
          }else{
            notification('Problema al eliminar','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });


}