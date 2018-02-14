$(document).ready(function() {
    $('.data-simple').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

function deleteCotizacion(IdCotizacion){
	confirm('¿Desea elimar el producto?', deleteCot, IdCotizacion);
}

function deleteCot(IdCotizacion){
    var formData = new FormData();
    formData.append('IdCotizacion', IdCotizacion);
    $.ajax({
        url: window.base_url+'Cotizacion_c/deleteCotizacion',
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
          	$('tr#'+IdCotizacion).remove();
            notification('Cotizacion eliminado <strong>correctamente!</strong>','success','topRight');
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
