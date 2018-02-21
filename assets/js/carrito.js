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