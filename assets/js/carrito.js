/*MOSTRAR CARRITO SI TIENE PRODUCTOS*/
$('li.carrito>a').click(function(e){
    e.preventDefault();
  	$.ajax({
  	    url: window.base_url+'Cart_c/getProductosFromCarrito',
  	    type: 'POST',
  	    cache: false,
  	    contentType: false,
  	    processData: false,
  	    beforeSend: function(){
  	      	console.log('Procesando');
  	    },
  	    success: function(data){
  	    	if (data!='Carrito vacio') {
  	    		$('div#carrito tbody').html(data);
  	    		$('#carritoModal').modal('show');
  	    	}else{
  	    		notification('El carrito esta vacio', '', 'info');
  	    	}
  	      	console.log(data);
  	    },
  	    error: function(data){
  	      	console.log('Error Ajax Peticion');
  	      	console.log(data);
  	    }
  	});
});
/*CAMBIO DE CANTIDAD EN CARRITO*/
$("div#carrito tbody").on("click", "div.dicrease>a", function(e){
    e.preventDefault();
    var IdProducto=$(this).parent('div').parent('td').prev('td').prev('th').parent('tr').attr('IdProducto');
    if ($(this).hasClass('minus')){
      var input=$(this).prev('div').children('input');
      var value=input.val();
      value=parseInt(value);
      value=value-1;
    }else if ($(this).hasClass('plus')){
      var input=$(this).prev('a').prev('div').children('input');
      var value=input.val();
      value=parseInt(value);
      value++;
    }
    if (value>=1) {
        input.val(value);
        updateValueProductoCart(value, IdProducto);
    }
});
function updateValueProductoCart(Value, IdProducto){
    var formData = new FormData();
    formData.append('Value', Value);
    formData.append('IdProducto', IdProducto);
    $.ajax({
        url: window.base_url+'Cart_c/uploadQtyCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            console.log('Procesando');
        },
        success: function(data){
          if (data=='Success') {
            var precio=$('tr#'+IdProducto+'>td.precio').attr('precio');
            precio=parseInt(precio);
            var importe=precio*Value;
            var importeFormateado=parseFloat(Math.round(importe * 100) / 100).toFixed(2);
            $('tr#'+IdProducto+'>td.importe').html(importeFormateado);
            $('tr#'+IdProducto+'>td.importe').attr('importe',importeFormateado);
            refreshTotal();
            notification('Cantidad cambiada', '', 'success');
          }
          console.log(data);
        },
        error: function(data){
            console.log('Error Ajax Peticion');
            console.log(data);
        }
    });
}
function deleteProductoFromCartModal(IdProducto){
    var formData = new FormData();
    formData.append('IdProducto', IdProducto);
    $.ajax({
        url: window.base_url+'Cart_c/deleteProductoFromCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            console.log('Procesando');
        },
        success: function(data){
          if (data=='Success') {
            notification('Producto eliminado', '', 'info');
            $('tr#'+IdProducto).remove();
            refreshTotal();
          }
          console.log(data);
        },
        error: function(data){
            console.log('Error Ajax Peticion');
            console.log(data);
        }
    });
}
function refreshTotal(){
  var subtotal=0;
  var subtotalFormateado=0;
  $( "td.importe" ).each(function() {
    var value=$(this).attr("importe");
    value=parseInt(value);
    subtotal=subtotal+value;
    subtotalFormateado=parseFloat(Math.round(subtotal * 100) / 100).toFixed(2);
  });
  var iva=$('td#total').attr('iva');
  iva=parseFloat(iva);
  console.log('IVA'+iva);
  var total=(subtotal*iva)+subtotal;
  totalFormateado=parseFloat(Math.round(total * 100) / 100).toFixed(2);
  $('td#subtotal').html(subtotalFormateado);
  $('td#total').html(totalFormateado);
}
