window.addEventListener("load", function () {
    window.loaded = true;
});

(function listen () {
    if (window.loaded) {
      $('div.loader').hide();
    } else {
      window.setTimeout(listen, 50);
    }
})();

var base_url;
window.base_url = "http://localhost/INNOVALED_V2/Productos/";

function notification(text, type, layout){
	$.noty.closeAll();
  	var n = noty({
  	  text: text,
  	  type: type,
  	  layout: layout,
      theme: 'defaultTheme',
      killer: true,
      timeout: 2000,
      animation: {
          open: 'animated bounceIn',
          close: 'animated fadeOut',
          speed: 250
      }
  	});
}

function confirm(text, functionName, param){

    var n = noty({
      text: text,
      type: 'information',//success, error, warning, information, notification
      layout: 'topRight',
      timeout: 500,
      animation: {
        open: 'animated bounceIn',
        close: 'animated fadeOut',
        speed: 250
      },
      buttons: [
        {addClass: 'btn btn-primary', text: 'Confirmar', onClick: function($noty) {
            $noty.close();
            functionName(param);
          }
        },
        {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
            $noty.close();
         }
        }
      ]
  });
}
