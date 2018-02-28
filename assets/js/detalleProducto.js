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
});