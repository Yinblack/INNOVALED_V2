/*MENU AUTO*/
$(window).scroll(function (event) {
	statusMenu();
});

function statusMenu(){
    var scroll = $(window).scrollTop();
    var position1 = $('section#Home').position();
    var part1 = position1.top;
    var part2 = part1+$('section#Home').height();

    var x=$('section#Servicios_1').position();
    var y=x.top;
    var part3=y+$('section#Servicios_1').height();
    
    var a=$('section#Empresas').position();
    var b=a.top;
    var part4=b+$('section#Empresas').height();
    
    var j=$('section#proyectos').position();
    var k=j.top;
    var part5=k+$('section#proyectos').height();
    
    if (scroll>part1 && scroll<part2) {
    	$('div#menu>div>div>ul>li>a').removeClass('active');
    	$('div#menu>div>div>ul>li>a.home').addClass('active');
    }else if (scroll>part2 && scroll<part3) {
    	$('div#menu>div>div>ul>li>a').removeClass('active');
    	$('div#menu>div>div>ul>li>a.servicios').addClass('active');
    }else if(scroll>part3 && scroll<part4){
    	$('div#menu>div>div>ul>li>a').removeClass('active');
    	$('div#menu>div>div>ul>li>a.nosotros').addClass('active');
    }else if(scroll>part4 && scroll<part5){
    	$('div#menu>div>div>ul>li>a').removeClass('active');
    	$('div#menu>div>div>ul>li>a.proyectos').addClass('active');
    }
}


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
        }
    }
});