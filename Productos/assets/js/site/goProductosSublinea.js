var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

(function listen () {
    if (window.loaded) {
        var IdSubLinea = getUrlParameter('s');
        if (IdSubLinea=='' || IdSubLinea==null) {
            console.log('not url value');
        }else{
            $("a.IdSubLinea"+IdSubLinea).first().trigger('click');
        }
    }else{
      window.setTimeout(listen, 50);
    }
})();

$("a.goProductosSublinea").click(function(e){
  	e.preventDefault();
  	if (!$(this).hasClass('active')) {
        var IdSubLinea = $(this).attr('href');
        var Name = $(this).attr('name');
        var newName = Name.replace(' ', '');
        history.pushState('data to be passed', 'Title of the page', '?s='+IdSubLinea+'&sl='+newName);
    	var formData = new FormData();
    	formData.append('IdSubLinea', IdSubLinea);
    	$.ajax({
    	    url: window.base_url+'Producto_c/getProductosFromSublinea',
    	    type: 'POST',
    	    data: formData,
    	    cache: false,
    	    contentType: false,
    	    processData: false,
    	    beforeSend: function(){
                $('div#containerProductos').empty();
                $('div#labels').empty();
    	      	$(this).addClass('active');
    	    },
    	    success: function(data){
    	      if (data=='Nan') {
                  $('<div class="col-xs-12 text-center verticalPadding"><strong>La sublinea no tiene productos</strong></div>').appendTo('div#containerProductos');
                  $('<h3 class="textBlack nomargin">La sublinea seleccionada no tiene productos</h3>').appendTo('div#labels');
    	      }else{
              hideCart();
              showProductosResult();
    	        var jsonObj=JSON.parse(data);
    	        for (var i = jsonObj.length - 1; i >= 0; i--) {
                    var IdProducto       =jsonObj[i]['IdProducto'];
                    var NombreProducto   =jsonObj[i]['NombreProducto'];
                    var Marca            =jsonObj[i]['Marca'];
                    var Precio           =jsonObj[i]['Precio'];
                    var MostrarPrecio    =jsonObj[i]['MostrarPrecio'];
                    var Descripcion      =jsonObj[i]['Descripcion'];
                    var Moneda           =jsonObj[i]['Moneda'];
                    var Sublinea         =jsonObj[i]['Sublinea'];
                    var Linea            =jsonObj[i]['Linea'];
                    var PrecioEscala     =jsonObj[i]['PrecioEscala'];
                    var shortDescripcion =Descripcion.slice(0, 100);

                    var OnCart           =jsonObj[i]['OnCart'];
                    if (OnCart=='Si'){
                        var active='active';
                        var textButton='EN LISTA';
                        var colorClass='btnEnLista'
                    }else{
                        var active='';
                        var textButton='COTIZAR';
                        var colorClass=''
                    }
                    if (PrecioEscala==1) {
                      var textPrecioEscala='<span class="textDscto pull-right">* Dscto por cantidad</span>';
                    }else if (PrecioEscala==0) {
                      var textPrecioEscala='';
                    }


    	          $('<div class="col-xs-13 item"><div class="col-xs-2 col-sm-1"><div class="col-xs-12 nopadding vertical"><div class="col-xs-12 vertical nopadding text-center"><div class="col-xs-12 nopadding centered" style="width: auto;"><a href="#" class="col-xs-12 centered aToCheckBox inputSquare '+active+'" IdProducto="'+IdProducto+'"><i class="fa fa-check" aria-hidden="true"></i></a><input type="checkbox" class="checkProyecto" name="'+IdProducto+'" value="'+IdProducto+'"></div></div></div></div><div class="col-xs-10 col-sm-9"><div class="col-xs-12 nopadding vertical"><div class="col-xs-12 nopadding"><div class="col-xs-4 nopadding text-center"><img src="assets/img/Productos/'+IdProducto+'/img_1.jpg" alt="" class="col-xs-12 centered"></div><div class="col-xs-8 nopadding"><div class="col-xs-12 col-sm-8"><h4 class="textGrey nomarginTop">'+NombreProducto+'<br><small>'+shortDescripcion+'...</small></h4><a href="DetalleProductoTwo?IdProducto='+IdProducto+'" class="more bold">VER MÁS</a> '+textPrecioEscala+' </div><div class="col-xs-12 col-sm-4"><h4 class="bold">'+Moneda+' '+Precio+'</h4></div></div></div></div></div><div class="col-xs-12 col-sm-2"><div class="col-xs-12 nopadding vertical"><div class="col-xs-12 nopadding text-center"><div class="col-xs-12 nopadding centered" style="width: 125px;"><div class="col-xs-4 nopadding text-center"><a href="#" class="square centered action" act="minus">-</a></div><div class="col-xs-4 nopadding text-center"><input type="text" class="square centered qty'+IdProducto+'" IdProducto="'+IdProducto+'" id="qty" name="qty" value="1"></div><div class="col-xs-4 nopadding text-center"><a href="#" class="square centered action" act="plus">+</a></div><div class="col-xs-12 nopadding text-center"><a href="#" class="btnCotizar '+colorClass+' " id="'+IdProducto+'" IdProducto="'+IdProducto+'"  Qty="1"><h4 class="nopadding nomargin">'+textButton+'</h4></a></div></div></div></div></div></div>').appendTo('div#containerProductos');
                  if(i == jsonObj.length-1){
                    $('<h5 class="textBlack light nomargin">'+Linea+'</h5><h3 class="textBlack nomargin bold text-uppercase">'+Sublinea+'</h3>').appendTo('div#labels');
                  }
                }
                $('html, body').animate({
                  scrollTop: $('#ProductosCotizacion').offset().top+40
                }, 800);
                return false;
    	      }
    	    },
    	    error: function(data){
    	      console.log('Error Ajax Peticion');
    	    }
    	});
	}
});