/*Validations*/
$( document ).ready(function() {
	$("#NuevaEscalaPrecio").validate({
    errorPlacement: function(error, element) {
      error.appendTo('#errordiv');
    },
    rules: {
        "Producto":     {
                        required :true
                      },
        "MayorQue":{
                        required :true
                      },
        "PorcentajeDescuento":{
                        required :true,
                        max: 99
                      }
    },
    messages: {
        "Producto":     {
                        required :"Producto: requiere ser llenado."
                      },
        "MayorQue":     {
                        required :"Mayor que: requiere ser llenado."
                      },
        "PorcentajeDescuento":     {
                        required :"Porcentaje de descuento: requiere ser llenado.",
                        max :"Porcentaje de descuento: El maximo permitido es 99%."
                      }
    }
	});
});
/*
PrecioBase
MayorQue
PorcentajeDescuento
Descuento
NuevoPrecio
*/

$("select#Producto").change(function(){
    var idProducto=$(this).val();
    var formData = new FormData();
    formData.append('IdProducto', idProducto);
      $.ajax({
          url: window.base_url+'Producto_c/getPrecioFromId',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data){
            $("input#PrecioBase").val(data);
            calcular();
          }
      });
});

$('input.values').on('input',function(e){
  calcular();
});

function calcular(){
  var porcentaje=$("input#PorcentajeDescuento").val();
  var precio=$("input#PrecioBase").val();
  if (porcentaje!='' && $.isNumeric(porcentaje)){
    var descuento=porcentaje/100*precio;
    $("input#Descuento").val(descuento);
    var nuevoPrecio=precio-(porcentaje/100*precio);
    $("input#NuevoPrecio").val(nuevoPrecio);
  }else{
    $("input#Descuento").val(' ');
    $("input#NuevoPrecio").val(' ');
  }
}

$(function() {
  $('button#formProcess').click(function() {
    var form = $( "#NuevaEscalaPrecio" );
    if ($(form).valid()) {
      console.log('valido');
      addEscalaPrecio(form);
    }else{
      console.log('no es valido');
    }
  });
});

function addEscalaPrecio(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/addEscalaPrecio',
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
            notification('Escala agregada <strong>correctamente.</strong>','success','topRight');
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