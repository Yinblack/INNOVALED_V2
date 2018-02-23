$( document ).ready(function() {
$('#containerProductosRelacionados').slick({
  arrows: false,
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  draggable: true,
  adaptiveHeight: true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
});
$("a.addToCart").click(function(e){
  	e.preventDefault();
	  	var IdProducto=$('input#IdProducto').val();
	  	var Qty=$('input#Qty').val();
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
					      $('a.cart span.items').html(data);
                setTimeout(function()
                {
                location.reload();
                }, 300);
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
});

$("a.delToCart").click(function(e){
    e.preventDefault();
      var IdProducto=$('input#IdProducto').val();
      var formData = new FormData();
      formData.append('id', IdProducto);
      $.ajax({
          url: window.base_url+'Cart_c/deleteProductoCart',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data){
            if (data=="success"){
                setTimeout(function()
                {
                location.reload();
                }, 300);
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
});

/*FUNCTIONS ON READY*/
$( document ).ready(function() {
 $('.sliderProducto').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.sliderThumbs'
});
$('.sliderThumbs').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.sliderProducto',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  vertical: true,
  arrows: false,
  infinite: false,
  responsive: [
    {
      breakpoint: 480,
      settings: {
        vertical: false
      }
    }
  ]
});
});
