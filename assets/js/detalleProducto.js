$( document ).ready(function() {
    $('.slideDetalleZoom').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        asNavFor: '.slideDetalleThumbs'
    });
    $('.slideDetalleThumbs').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slideDetalleZoom',
        dots: true,
        centerMode: true,
        focusOnSelect: true,
        responsive: [
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2
            }
          }
        ]
    });
  $('div#slideProductosRelacionados').slick({
    arrows: true,
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    autoplay: true,
    draggable: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 680,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
});

$('a#Cotizar').click(function(e){
    e.preventDefault();
    var IdProducto=$('input#IdProducto').val();
    var Cantidad=1;
    addProductoToCart(IdProducto, Cantidad);
    $('a#Cotizar').hide();
    $('a#Quitar').show();
});

$('a#Quitar').click(function(e){
    e.preventDefault();
    var IdProducto=$('input#IdProducto').val();
    deleteProductoFromCart(IdProducto);
    $('a#Cotizar').show();
    $('a#Quitar').hide();
});


function isOnCart(){
    var IdProducto=$('input#IdProducto').val();
    var formData = new FormData();
    formData.append('IdProducto', IdProducto);
    $.ajax({
        url: window.base_url+'Cart_c/isOnCart',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
          if (data=='true'){
            $('a#Cotizar').hide();
            $('a#Quitar').show();
          }else{
            $('a#Cotizar').show();
            $('a#Quitar').hide();
          }
        }
    });
}