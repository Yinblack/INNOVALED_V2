$( document ).ready(function() {
  $('.modal-options').iziModal({
    headerColor: '#030463',
    width: '50%',
    overlayColor: 'rgba(0, 0, 0, 0.5)',
    fullscreen: true,
    transitionIn: 'fadeInUp',
    transitionOut: 'fadeOutDown'
  });
  $('.beforeSend').iziModal({
    headerColor: '#030463',
    width: 400,
    timeout: 10000,
    pauseOnHover: true,
    timeoutProgressbar: true,
    attached: 'bottom'
  });
});

$("a#cartIcon").click(function(e){
  e.preventDefault();
  $('html, body').animate({
    scrollTop: $('#topBarCarrito').offset().top-120
  }, 800);
  showCart();
  return false;
});

/*SHOW CART ON LOAD*/
window.addEventListener("load", function () {
    window.loaded = true;
});
(function listen () {
    if (window.loaded) {
      if($("div#containerItemsCart div.item").length>0){
        showCart();
      }
    }else{
      window.setTimeout(listen, 50);
    }
})();


/*TOGGLE CART*/
$("div#topBarCarrito").click(function(e){
    e.preventDefault();
    if ($(this).hasClass('onShow')){
      hideCart();
    }else{
      showCart();
    }
});


/*TOGGLE PRODUCTOS DERIVADOS DE SUBLINEAS*/
$("div#toggleProductosCotizar").click(function(e){
    e.preventDefault();
    if ($(this).hasClass('onShow')){
      hideProductosResult();
    }else{
      showProductosResult();
    }
});

function showProductosResult(){
  	var div=$('div#containerProductos');
    div.slideDown(100);
    $("a.toggleProductosResult").addClass('onShow');
    $("div#toggleProductosCotizar").addClass('onShow');
}

function hideProductosResult(){
	var div=$('div#containerProductos');
  div.slideUp(100);
  $("a.toggleProductosResult").removeClass('onShow');
  $("div#toggleProductosCotizar").removeClass('onShow');
}

/*
$("a.toggleProductosResult").click(function(e){
  	e.preventDefault();
  	if ($(this).hasClass('onShow')){
      hideProductosResult();
  	}else{
      showProductosResult();
  	}
});

$("a.toggleCart").click(function(e){
  	e.preventDefault();
  	if ($(this).hasClass('onShow')){
      hideCart();
  	}else{
      showCart();
  	}
});
*/
function showCart(){
  refreshCart();
}

function hideCart(){
  var cart=$('div.partCart');
  cart.slideUp(100);
  $("div#topBarCarrito").removeClass('onShow');
}

function refreshCart(){
      $.ajax({
          url: window.base_url+'Cart_c/getProductosFromCarrito',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $('div#containerItemsCart').empty();
          },
          success: function(data){
            if (data=='Nan') {
              $('<div class="col-xs-12 text-center verticalPadding"><strong>Agregue productos al carrito</strong></div>').appendTo('div#containerItemsCart');
            }else{
              hideProductosResult();
              var jsonObj=JSON.parse(data);
              for (var i = jsonObj.length - 1; i >= 0; i--) {
                    var id                    =jsonObj[i]['id'];
                    var name                  =jsonObj[i]['name'];
                    var qty                   =jsonObj[i]['qty'];
                    var price                 =jsonObj[i]['price'];
                    var rowid                 =jsonObj[i]['rowid'];
                    var totalPrecioByProducto =jsonObj[i]['totalPrecioByProducto'];
                    $('<div class="col-xs-12 item" id="'+id+'"><div class="col-xs-4"><div class="col-xs-12 nopadding verticalContainer"><div class="col-xs-12 vertical nopadding text-center"><h3 class="regular nomargin">'+name+'</h3></div></div></div><div class="col-xs-3 containerNoItems"><div class="col-xs-12 nopadding verticalContainer"><div class="col-xs-12 nopadding vertical"><div class="col-xs-4 nopadding text-center"><a href="#" class="square centered action" act="minus">-</a></div><div class="col-xs-4 nopadding text-center"><input type="text" class="square centered" id="qty" name="qty" rowid="'+rowid+'" value="'+qty+'"><input type="hidden" id="price" name="price" value="'+price+'"></div><div class="col-xs-4 nopadding text-center"><a href="#" class="square centered action" act="plus">+</a></div></div></div></div><div class="col-xs-2"><div class="col-xs-12 nopadding verticalContainer"><div class="col-xs-12 nopadding vertical text-center"><span>S/ '+price+'</span></div></div></div><div class="col-xs-2"><div class="col-xs-12 nopadding verticalContainer"><div class="col-xs-12 nopadding vertical text-center"><span id="'+rowid+'">'+totalPrecioByProducto+'</span></div></div></div><div class="col-xs-1"><div class="col-xs-12 nopadding verticalContainer"><div class="col-xs-12 nopadding vertical text-center"><a onclick="deleteItemFromCart('+id+');"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div></div></div>').appendTo('div#containerItemsCart');
                }
            }
            var cart=$('div.partCart');
            cart.slideDown(100);
            $("div#topBarCarrito").addClass('onShow');
          },
          error: function(data){
            console.log('Error Ajax Peticion');
          }
      });
}


$("div#containerProductos").on("click", "a.btnCotizar", function(e){
  e.preventDefault();
	  	var IdProducto=$(this).attr('IdProducto');
	  	var Qty=$(this).attr('Qty');
      $(this).parent().parent().parent().parent().prev().prev().children().children().children().children('a').addClass('active');
      $(this).parent().parent().parent().parent().prev().prev().children().children().children().children('a').children('input').prop('checked', true);
      $(this).children('h4').html('EN LISTA');
      $(this).addClass('btnEnLista');
      addItemToCart(IdProducto, Qty);
});

/*INCREMENTO QTY*/
$("div#containerProductos").on("click", "a.action", function(e){
  e.preventDefault();
  var action =  $(this).attr('act');
  if (action=='plus') {
    var inputElement=$(this).parent('div').prev('div').children('input');
    var val=inputElement.val();
    val=parseInt(val)+1;
    inputElement.val(val);
    $(this).parent('div').next('div').children('a').attr('qty', val);
  }else if(action=='minus'){
    var inputElement=$(this).parent('div').next('div').children('input');
    var val=inputElement.val();
    val=parseInt(val)-1;
    if (val>=1) {
      inputElement.val(val);
      $(this).parent('div').next('div').next('div').next('div').children('a').attr('qty', val);
    }
  }
});

$("div#containerProductos").on("keydown keyup", "input.square", function(){
  var val=$(this).val();
  if (val>0) {
    $(this).parent('div').next('div').next('div').children('a').attr('qty', val);
  }
});

$("div#containerItemsCart").on("click", "a.action", function(e){
  e.preventDefault();
  var action =  $(this).attr('act');
  if (action=='plus') {
    var inputElement=$(this).parent('div').prev('div').children('input#qty');
    var val=inputElement.val();
    val=parseInt(val)+1;
    inputElement.val(val);
    var rowid=inputElement.attr('rowid');
    uploadCart(rowid, val);
  }else if(action=='minus'){
    var inputElement=$(this).parent('div').next('div').children('input#qty');
    var val=inputElement.val();
    val=parseInt(val)-1;
    if (val>=1) {
      inputElement.val(val);
      var rowid=inputElement.attr('rowid');
      uploadCart(rowid, val);
    }
  }
});

$("div#containerItemsCart").on("focusout", "input.square", function(){
  var val=$(this).val();
  if (val>0) {
    var rowid=$(this).attr('rowid');
    var precio= $(this).next('input').val();
    var importe=val*precio;
    $('span#'+rowid).html(importe);
    uploadCart(rowid, val);
    console.log('changed from input');
  }
});

function uploadCart(rowid, Qty){
   	var formData = new FormData();
   	formData.append('rowid', rowid);
   	formData.append('Qty', Qty);
   	$.ajax({
   	    url: window.base_url+'Cart_c/uploadQtyCart',
   	    type: 'POST',
   	    data: formData,
   	    cache: false,
   	    contentType: false,
   	    processData: false,
        beforeSend: function(){
          $('div#containerItemsCart').empty();
          $('<div class="col-xs-12 text-center verticalPadding"><img src="assets/img/loaderCart.svg" class="text-center centered verticalPadding" style="display: block; position: relative; width: 40px;"></div>').appendTo('div#containerItemsCart');
        },
   	    success: function(data){
   	    	console.log(data);
          refreshCart();
   	    },
   	    error: function(data){
   	    	console.log('Error Ajax Peticion');
   	    	console.log(data);
   	    }
   	});
}


$("a.submitCotizacionProductos").click(function(e){
  e.preventDefault();
  var form=$("form#CotizacionDatosCliente");
  if ($(form).valid()) {
    console.log('valido');
    sendCotizacion(form);
  }else{
    console.log('no es valido :D');
  }
});

$( document ).ready(function() {
  $("form#CotizacionDatosCliente").validate({
    errorPlacement: function(error, element) {
        error.insertBefore(element);
    },
    rules: {
      "nombre":     {
      required :true
      },
      "correo":     {
      require_from_group: [1, ".group"],
      email: true
      },
      "telefono":     {
      require_from_group: [1, ".group"],
      number: true,
      maxlength: 16,
      minlength: 8
      }
    },
    messages: {
      "nombre":     {
      required :"Este campo es obligatorio."
      },
      "correo":     {
      require_from_group :"Complete uno de estos campos.",
      email :"El Email no es valido."
      },
      "telefono":     {
      require_from_group :"Complete uno de estos campos.",
      number:"Numero de telefono no valido",
      maxlength:"Numero demasiado largo",
      minlength:"Numero demasiado corto"
      }
    }
  });
});

function sendCotizacion(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Cart_c/sendCotizacion',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
          $('.beforeSend').iziModal('open');
        },
        success: function(data){
            $('.beforeSend').iziModal('close');
            $('.modal-options').iziModal('open');
            $(form)[0].reset();
            var win = window.open(window.base_url+"CotizacionPdf?IdCotizacion="+data, '_blank');
            win.focus();
            console.log('url opened');
            setTimeout(function()
            {
              location.href = window.base_url+"Productos";
            }, 5000);
              $('a.cart span.items').html(0);
              $('div.number').html(0);
              $('div#containerItemsCart').empty();
              hideCart();
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}


/*CHECKBOX PRODUCTO*/
$("div#containerProductos").on("click", "a.aToCheckBox", function(e){
  e.preventDefault();
  var IdProducto=$(this).attr('IdProducto');
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
    $(this).parent().parent().parent().parent().next().next().children().children().children().children().children('h4').html('COTIZAR');
    $(this).parent().parent().parent().parent().next().next().children().children().children().children().removeClass('btnEnLista');
    deleteItemFromCart(IdProducto);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
    $(this).parent().parent().parent().parent().next().next().children().children().children().children().children('h4').html('EN LISTA');
    $(this).parent().parent().parent().parent().next().next().children().children().children().children().addClass('btnEnLista');
    var Qty=$('input.qty'+IdProducto).val();
    addItemToCart(IdProducto, Qty);
  }
});

/*CART FUNCTIONS*/
function addItemToCart(IdProducto, Qty){
      var formData = new FormData();
      formData.append('IdProducto', IdProducto);
      formData.append('Qty', Qty);
      $.ajax({
          url: window.base_url+'Cart_c/addProductoToCart',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data){
            if (data!="Error" && data!="Existe"){
              noty({
                  text: '<span class="textWhite"><strong class="textWhite">Correcto</strong><br>El producto ha sido agregado!</span>',
                  type: 'success',
                  layout: 'topRight',
                  dismissQueue: true,
                  force: false, // [boolean] adds notification to the beginning of queue when set to true
                  maxVisible: 5, // [integer] you can set max visible notification count for dismissQueue true option,
                  template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
                  timeout: 2000,
                  progressBar: true,
                  animation: {
                      open: 'animated bounceIn',
                      close: 'animated fadeOut',
                      speed: 200
                  }
              });
              $('a.cart span.items').html(data);
              if (data>0) {
                $('div.number').removeClass('empty');
              }
              $('div.number').html(data);
            }else{
              console.log('Error al añadir al carrito');
            }
            console.log(data);
          },
          error: function(data){
            console.log('Error Ajax Peticion');
            console.log(data);
          }
      });
}

function deleteItemFromCart(id){
    var formData = new FormData();
    formData.append('id', id);
    $.ajax({
        url: window.base_url+'Cart_c/deleteProductoCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
          if (data=='success') {
            noty({
                text: '<span class="textWhite"><strong class="textWhite">Correcto</strong><br>Producto eliminado!</span>',
                type: 'information',
                layout: 'topRight',
                dismissQueue: true,
                force: false, // [boolean] adds notification to the beginning of queue when set to true
                maxVisible: 5, // [integer] you can set max visible notification count for dismissQueue true option,
                template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
                timeout: 2000,
                progressBar: true,
                animation: {
                    open: 'animated bounceIn',
                    close: 'animated fadeOut',
                    speed: 200
                }
              });
              var numItems=$('a.cart span.items').html();
              numItems=parseInt(numItems);
              var newNumitems=numItems-1;
              $('a.cart span.items').html(newNumitems);
              if (newNumitems==0) {
                $('div.number').addClass('empty');
              }
              $('div.number').html(newNumitems);
              $('div.item#'+id+'').remove();
          }else{
              console.log('error');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}
