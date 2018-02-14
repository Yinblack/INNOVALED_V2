/*Indexacion de array arrayOrderMentores*/
var arrayOrderMentores;
window.arrayOrderMentores={};
var jsonArray;
window.jsonArray='';
function DeleteMtr(idMtr){
	confirm('¿Desea elimar el evento?', deleteMentor, idMtr);
}

function deleteMentor(idMtr){

  var formData = new FormData();
    
    formData.append('idMtr', idMtr);

    $.ajax({
        url: window.base_url+'Mentor_c/deleteMentor',
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
          	$('tr#'+idMtr).remove();
            notification('Mentor eliminado <strong>correctamente!</strong>','success','topRight');
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

$( function() {
  $( "#sortable" ).sortable({
      stop: function(e, ui) {
          $.map($(this).find('li'), function(el) {
              var Orden=$(el).index();
              var idItem=el.id;
              window.arrayOrderMentores[idItem] = Orden;
          });
          window.jsonArray = JSON.stringify( window.arrayOrderMentores );
          console.log(window.arrayOrderMentores);
          $('button#processOrder').show();
      }
  });
} );

$(function() {
  $('button#processOrder').click(function() {
    CambiarOrdenMentores();
  });
});

function CambiarOrdenMentores(){

  var formData = new FormData();
    
    formData.append('jsonArrayOrder', window.jsonArray);

    $.ajax({
        url: window.base_url+'Mentor_c/CambiarOrdenMentores',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
        },
        success: function(data){
          if (data=='success'){
            notification('Orden actualizado <strong>correctamente!</strong>','success','topRight');
            setTimeout(function(){ 
              location.reload(); 
            }, 300);
          }else{
            notification('Problema al actualizar','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });


}