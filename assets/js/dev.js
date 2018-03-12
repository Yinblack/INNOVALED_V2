var base_url;
//window.base_url = "https://www.innovaled.pe/v2/Admin/";
window.base_url = "http://localhost/INNOVALED_V2/Admin/";
$( document ).ready(function() {
  
$(".col-3 input").val("");
$(".col-3 textarea").val("");
$(".input-effect input").focusout(function(){
  if($(this).val() != ""){
    $(this).addClass("has-content");
  }else{
    $(this).removeClass("has-content");
  }
})
$(".input-effect textarea").focusout(function(){
  if($(this).val() != ""){
    $(this).addClass("has-content");
  }else{
    $(this).removeClass("has-content");
  }
})

$('#principal').parallax();

window.sr = ScrollReveal();
sr.reveal('.revealBack', { 
      duration: 1000,
      origin: 'bottom',
      distance: '50px',
      delay: 150,
      scale: 1.2
    });
sr.reveal('.revealBottom', { 
      duration: 1250,
      origin: 'bottom',
      distance: '20px',
      delay: 500,
      scale: 0.5 
    });
});

window.addEventListener("load", function () {
    window.loaded = true;
});

(function listen () {
    if (window.loaded) {
      $('div.loaderPage').hide();
      $("section#Productos div.tabsGeneral div.item div.subItem>a.firstElement").trigger('click');
      $("section#Productos div.tabsGeneral div.item div.subItem>a.firstElement").addClass('active');
      cartHasContent();
      initMap();
    } else {
      window.setTimeout(listen, 50);
    }
})();


$( document ).ready(function() {
  $('div.containerTabs').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false
  });
  $('div#slideProjects').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false,
    cssEase: 'ease',
    fade: true
  });
  $('#slideMarcas').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false,
    initialSlide: 1
  });
  $('section#Home').slick({
    arrows: false,
    dots: true,
    infinite: true,
    autoplaySpeed: 4000,
    speed: 500,
    slidesToShow: 1,
    autoplay: true
  });
});
$(document).ready(function() {
    $('section#Home').on('init', function(e, slick) {
        var $firstAnimatingElements = $('div.slide:first-child').find('[data-animation]');
        doAnimations($firstAnimatingElements);    
    });
    $('section#Home').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
              var $animatingElements = $('div.slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
              doAnimations($animatingElements);    
    });
    function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function() {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay
            });
            $this.addClass($animationType).one(animationEndEvents, function() {
                $this.removeClass($animationType);
            });
        });
    }
});


$("section#Servicios_1 div.tabs>div>a").click(function(e){
  e.preventDefault();
    if (!$( this ).hasClass( "active" )) {
      $("section#Servicios_1 div.tabs>div>a.active").removeClass('active');
      $(this).addClass('active');
      var index=$(this).attr('slideTo');
      $('div.containerTabs').slick('slickGoTo', index);
    }
});
$("section#proyectos ul.projectList>li>a").click(function(e){
  e.preventDefault();
  $("section#proyectos ul.projectList>li>a").removeClass('active');
  $(this).addClass('active');
  var index=$(this).attr('href');
  $('div#slideProjects').slick('slickGoTo', index);
});
$("section#Empresas div.tabBrand>div a").click(function(e){
  e.preventDefault();
    if (!$( this ).hasClass( "active" )) {
      $("section#Empresas div.tabBrand>div a").removeClass('active');
      $(this).addClass('active');
      var index=$(this).attr('slideTo');
      $('#slideMarcas').slick('slickGoTo', index);
    }
});

function notification(tittle, text, type){
  PNotify.removeAll();
  new PNotify({
    title: tittle,
    text: text,
    type: type
  });
}

$("div#hamburgerMenu>div>a.search>svg").click(function(e){
  e.preventDefault();
  var element=$(this).prev('input');
  if (element.hasClass('active')) {
    element.removeClass('active');
  }else{
    element.addClass('active');
  }
});

$("section#proyectos a.backImg").click(function(e){
  e.preventDefault();
  var clase=$(this).attr('href');
  var index=$('section#proyectos div.content div.slideItem.'+clase).attr('data-slick-index');
  $('div#slideProjects').slick('slickGoTo', index);
});

$("section#proyectos div.content div.slideItem div.next>img").click(function(e){
  e.preventDefault();
  var clase=$(this).attr('index');
  var index=$('section#proyectos div.content div.slideItem.'+clase).attr('data-slick-index');
  $('div#slideProjects').slick('slickGoTo', index);
});

function cartHasContent(){
    $.ajax({
        url: window.base_url+'Cart_c/hasContent',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
          var containerCartButton=$('div#Menu.fixed>div>a.containerSession');
          if (data=='Success'){
            containerCartButton.removeClass('disabled');
          }else{
            containerCartButton.addClass('disabled');
          }
          console.log('Carrito has content: '+data);
        }
    });
}