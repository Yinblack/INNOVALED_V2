$(document).ready(function() {
    $('.data-simple').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

function deletePrecioEscala(IdEscalaPrecio){
	confirm('¿Desea elimar el producto?', deleteEscPrecio, IdEscalaPrecio);
}

function deleteEscPrecio(IdEscalaPrecio){

  var formData = new FormData();

    formData.append('IdEscalaPrecio', IdEscalaPrecio);

    $.ajax({
        url: window.base_url+'Producto_c/deletePrecioEscala',
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
          	$('tr#'+IdEscalaPrecio).remove();
            notification('Producto eliminado <strong>correctamente!</strong>','success','topRight');
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
