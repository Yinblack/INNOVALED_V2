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
          	  $('tr#'+idEvt).remove();
            notification('Evento eliminado <strong>correctamente!</strong>','success','topRight');
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