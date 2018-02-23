var base_url;
window.base_url = "http://localhost/INNOVALED_V2/Productos/";
var tabPosition;
window.tabPosition = 0;


/*STYLES AND SCRIPTS ON LOAD*/
window.addEventListener("load", function () {
    window.loaded = true;
});
(function listen () {
    if (window.loaded) {
      $('div.loaderPage').hide();
      $('button.hamburger').click();
    } else {
      window.setTimeout(listen, 50);
    }
})();

$(document).ready(function(){
    $('#gallery').slick({
      arrows: false,
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      autoplay: true,
      draggable: true
    });
});

var resizeTimer;

$(window).on('resize', function(e) {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
    if ($(window).width() < 992) {
      var containerOptions=$("div#Menu>div>div.containerOptions");
      var containerSession=$('div#Menu>div>a.containerSession');
      $(".hamburger").removeClass('is-active');
      containerOptions.hide();
      containerSession.hide();
    }else{
      var containerOptions=$("div#Menu>div>div.containerOptions");
      var containerSession=$('div#Menu>div>a.containerSession');
      $(".hamburger").addClass('is-active');
      containerOptions.show();
      containerSession.show();
    }
  }, 500);
});

/*MENU*/
$(".hamburger").click(function(){

if ($(window).width() < 992) {
  var containerOptions=$("div#Menu>div>div.containerOptions");
  var containerSession=$('div#Menu>div>a.containerSession');
    $(this).toggleClass("is-active");
    if ($( this ).hasClass( "is-active" )){
      $( this ).addClass('active');
      containerOptions.show();
      containerSession.show();
    }else{
      $( this ).removeClass('active');
      containerOptions.hide();
      containerSession.hide();
    }
}
else {
  var menu=$("div#Menu");
  var section=$(".onepage-wrapper .section div.flex");
  var image=$("section.Servicios img.fixed");
  var sectionNormal=$("section.normalSection");
    $(this).toggleClass("is-active");
    if ($( this ).hasClass( "is-active" )){
      $( this ).addClass('active');
      menu.removeClass('fixed');
      section.removeClass('full');
      image.removeClass('dobleFixed');
      sectionNormal.removeClass('fixed');
    }else{
      $( this ).removeClass('active');
      menu.addClass('fixed');
      section.addClass('full');
      image.addClass('dobleFixed');
      sectionNormal.addClass('fixed');
    }
}
$('#slideBanners')[0].slick.refresh();
});

$("div#Menu").mouseenter(function() {
    if ($(window).width() > 992) {
        var hamburger=$(".hamburger");
        if(!$(hamburger).hasClass('is-active')){
            var menu=$("div#Menu");
            var section=$(".onepage-wrapper .section div.flex");
            var image=$("section.Servicios img.fixed");
            var sectionNormal=$("section.normalSection");
            $(hamburger).addClass("is-active");
            menu.removeClass('fixed');
            section.removeClass('full');
            image.removeClass('dobleFixed');
            sectionNormal.removeClass('fixed');
            $('#slideBanners')[0].slick.refresh();
        }
    }
}).mouseleave(function() {
    if ($(window).width() > 992) {
        var hamburger=$(".hamburger");
        if($(hamburger).hasClass('is-active')){
            var menu=$("div#Menu");
            var section=$(".onepage-wrapper .section div.flex");
            var image=$("section.Servicios img.fixed");
            var sectionNormal=$("section.normalSection");
            $(hamburger).removeClass("is-active");
            menu.addClass('fixed');
            section.addClass('full');
            image.addClass('dobleFixed');
            sectionNormal.addClass('fixed');
            $('#slideBanners')[0].slick.refresh();
        }
    }
});


/*MENU ACTIVE*/
$("div.containerOptions a").click(function(e){
  e.preventDefault();
  if ($(this).hasClass('active')){

  }else{
    $("div.containerOptions a").removeClass('active');
      var position=$(this).attr('to');
      if (position=='productos') {
        window.location.href="Productos";
      }else if($(this).hasClass('goToId')){
        window.location.href="Home";
      }else if($(this).hasClass('href')){
        var href=$(this).attr('href');
        window.location.href=href;
      }else{
        $(".main").moveTo(position);
        $(this).addClass('active');
      }
  }
});



/*INPUTS*/
$('input.Style1').change(function() {
  if ($(this).val()) {
    $(this).next('span.placeholder').addClass('active');
  }else{
    $(this).next('span.placeholder').removeClass('active');
  }
});

function goBack() {
    window.history.back();
}
