$("section#Productos ul.linea>li>a").click(function(e){
  e.preventDefault();
    if (!$( this ).hasClass( "active" )) {
    	$("section#Productos ul.linea>li>a").removeClass('active');
    	var index=$(this).attr('href');
    	$('section#Productos div.tabsGeneral').slick('slickGoTo', index);
    	$(this).addClass('active');
    }
});

$("section#Productos div.tabsGeneral div.item div.subItem>a").click(function(e){
  e.preventDefault();
    if (!$( this ).hasClass( "active" )) {
    	$("section#Productos div.tabsGeneral div.item div.subItem>a").removeClass('active');
    	var IdSublinea=$(this).attr('href');
    	showProductos(IdSublinea);
    	$(this).addClass('active');
    }
});

function showProductos(IdSubLinea){
  	var formData = new FormData();
  	formData.append('IdSubLinea', IdSubLinea);
  	var containerProductos=$('div#containerProductos');
    $.ajax({
        url: window.base_url+'Producto_c/getProductosFromSublineaReturnItems',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data!='error'){
          		containerProductos.html(data);
          }else{
          		containerProductos.html("<h3 class='col-xs-12 text-center textWhite'>NO HAY PRODUCTOS EN ESTA SUBLINEA</h3>");
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

function getSubLineas(IdLinea){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'Producto_c/getSubLineasFromLinea',
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
            notification('Inicio de sesión <strong>Correcto!</strong>','success','topRight', false);
            setTimeout(function() {
              location.reload();
            }, 350);
          }else{
            notification('Usuario o contraseña incorrectos','error','topRight', 2000);
          }
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}
$( document ).ready(function() {
  $('section#Productos div.tabsGeneral').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false
  });
  $('section#Productos div.tabsGeneral div.item').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    autoplay: false,
    draggable: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
});

$('section#Productos div.arrows a.next').click(function(e){
    e.preventDefault();
    $("section#Productos div.tabsGeneral div.item").slick("slickNext");
});
$('section#Productos div.arrows a.prev').click(function(e){
    e.preventDefault();
    $("section#Productos div.tabsGeneral div.item").slick("slickPrev");
});

/*CHECKBOX*/
/*checkbox normal*/
$('div.checkbox').click(function(e){
    e.preventDefault();
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).children("input").prop('checked', false);
    }else{
        $(this).addClass('active');
        $(this).children("input").prop('checked', true);
    }
});
/*checkbox creado*/
$("section#Productos div.productos").on("click", "div.checkbox", function(e){
    e.preventDefault();
    if ($(this).hasClass('active')) {
        var IdProducto=$(this).attr('IdProducto');
        deleteProductoFromCart(IdProducto);
    }else{
        var IdProducto=$(this).attr('IdProducto');
        var Cantidad=$('input.Cantidad'+IdProducto).val();
        addProductoToCart(IdProducto, Cantidad);
    }
});

function addProductoToCart(IdProducto, Cantidad){
  var formData = new FormData();
  formData.append('IdProducto', IdProducto);
  formData.append('Cantidad', Cantidad);
  console.log('IdProducto: '+IdProducto);
  console.log('+++++');
  console.log('Cantidad: '+Cantidad);
    $.ajax({
        url: window.base_url+'Cart_c/addProductoToCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='Success'){
            notification('Producto agregado', '', 'success');
            $('div#item'+IdProducto+' div.checkbox ').addClass('active');
            $('div#item'+IdProducto+' div.checkbox ').children("input").prop('checked', true);
            cartHasContent();
          }else if (data=='Cantidad'){
            $('div#item'+IdProducto+' div.checkbox ').removeClass('active');
            notification('Seleccione una cantidad', '', 'info');
          }else{
            notification('Error al agregar', '', 'error');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}
function deleteProductoFromCart(IdProducto){
  var formData = new FormData();
  formData.append('IdProducto', IdProducto);
    $.ajax({
        url: window.base_url+'Cart_c/deleteProductoFromCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Eliminando');
        },
        success: function(data){
          if (data=='Success'){
            $('div#item'+IdProducto+' div.checkbox ').removeClass('active');
            $('div#item'+IdProducto+' div.checkbox ').children("input").prop('checked', false);
            $('input.Cantidad'+IdProducto).val(0);
            cartHasContent();
            notification('Producto eliminado', '', 'info');
          }else{
            notification('Error al eliminar', '', 'error');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

$("section#Productos div.productos").on("click", "div.dicrease>a", function(e){
    e.preventDefault();
    if ($(this).hasClass('minus')){
    	var input=$(this).prev('div').children('input');
    	var value=input.val();
    	value=parseInt(value);
    	value=value-1;
    }else if ($(this).hasClass('plus')){
    	var input=$(this).prev('a').prev('div').children('input');
      var value=input.val();
    	value=parseInt(value);
    	value++;
    }
    if (value>=1) {
      input.val(value);
      var checkboxContainer=input.parent().parent().parent().parent().parent().prev().prev().children().children().children();
      var IdProducto=checkboxContainer.attr('idproducto');
      if (!checkboxContainer.hasClass('active')) {
        addProductoToCart(IdProducto, value);
        cartHasContent();
      }else{
        updateValueProductoCart(value, IdProducto);
      }
    }
});