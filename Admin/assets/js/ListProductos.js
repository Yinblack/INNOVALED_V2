$(document).ready(function() {
    $('.data-simple').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

function deleteProducto(idProducto){
	confirm('¿Desea elimar el producto?', deleteProd, idProducto);
}

function deleteProd(IdProducto){

  var formData = new FormData();

    formData.append('IdProducto', IdProducto);

    $.ajax({
        url: window.base_url+'Producto_c/deleteProducto',
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
          	$('tr#'+IdProducto).remove();
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
