var base_url;
window.base_url = "http://localhost/INNOVALED_V2/Admin/";
$( document ).ready(function() {
    $('#principal').parallax();
    window.sr = ScrollReveal({ duration: 1000 }).reveal('.reveal');
});


$('.scrollTo').click(function(e){
  if ($(window).width() < 768) {
	  if ($('div#menu').is(":visible")) {
	  	$("div#menu").slideUp(500);
	  	$(".hamburger").removeClass("is-active");
	  }
  }
	e.preventDefault();
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
   	  	var target = $(this.hash);
   	  	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
   	  	if (target.length) {
   	  	  	$('html, body').animate({
   	  	  	  scrollTop: target.offset().top-91
   	  	  	}, 800);
   	  	  	return false;
   	  	}
   	}
});

window.addEventListener("load", function () {
    window.loaded = true;
});

(function listen () {
    if (window.loaded) {
      $('div.loaderPage').hide();
    } else {
      window.setTimeout(listen, 50);
    }
})();

$(".hamburger").click(function(){
    $(this).toggleClass("is-active");
    if ($( this ).hasClass( "is-active" )) {
    	$("div#menu").slideDown(500);
    }else{
    	$("div#menu").slideUp(500);
    }
});




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
    draggable: false
  });
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
    if (!$( this ).hasClass( "active" )) {
      $("section#proyectos ul.projectList>li>a").removeClass('active');
      $(this).addClass('active');
      var index=$(this).attr('href');
      $('div#slideProjects').slick('slickGoTo', index);
    }
});
$("div#menu>div>div>ul>li>a.scroll").click(function(e){
  if (!$(this).hasClass('directLink')) {
  e.preventDefault();
    if (!$( this ).hasClass( "active" )) {
      $("div#menu>div>div>ul>li>a").removeClass('active');
      e.preventDefault();
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top
              }, 800);
              $(this).addClass('active');
              return false;
          }
      }
    }
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