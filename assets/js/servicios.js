$( document ).ready(function() {
    $('.slideTittleServicio').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        autoplay: false,
        arrows: false,
        dots: false,
        autoplay: false,
        waitForAnimate: false
    });
});
$('section#servicios div.tittleServicio a.prev').click(function(e){
    e.preventDefault();
    $(".slideTittleServicio").slickPrev();
});
$('section#servicios div.tittleServicio a.next').click(function(e){
    e.preventDefault();
    $(".slideTittleServicio").slickNext();
});