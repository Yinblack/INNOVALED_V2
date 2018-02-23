function DeleteUsr(idUsr){
	confirm('¿Desea elimar el evento?', deleteUsuario, idUsr);
}

function deleteUsuario(idUsr){

  var formData = new FormData();
    
    formData.append('idUsr', idUsr);

    $.ajax({
        url: window.base_url+'Persona_c/deleteUsuario',
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
          	$('tr#'+idUsr).remove();
            notification('Usuario eliminado <strong>correctamente!</strong>','success','topRight');
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