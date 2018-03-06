/*MENU AUTO*/
$(window).scroll(function (event) {
	statusMenu();
});

function statusMenu(){
    var scroll = $(window).scrollTop();
    var position1 = $('section#Home').position();
    var part1 = position1.top;
    var part2 = part1+$('section#Home').height()-150;

    var x=$('section#Servicios_1').position();
    var y=x.top;
    var part3=y+$('section#Servicios_1').height()-150;
    
    var a=$('section#Empresas').position();
    var b=a.top;
    var part4=b+$('section#Empresas').height()-150;
    
    var j=$('section#proyectos').position();
    var k=j.top;
    var part5=k+$('section#proyectos').height()-150;
    
    if (scroll>part1 && scroll<part2) {
    	$('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
    	$('div#Menu>div>div.containerOptions>ul>li>a.home').addClass('active');
    }else if (scroll>part2 && scroll<part3) {
    	$('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
    	$('div#Menu>div>div.containerOptions>ul>li>a.servicios').addClass('active');
    }else if(scroll>part3 && scroll<part4){
    	$('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
    	$('div#Menu>div>div.containerOptions>ul>li>a.clientes').addClass('active');
    }else if(scroll>part4 && scroll<part5){
    	$('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
    	$('div#Menu>div>div.containerOptions>ul>li>a.proyectos').addClass('active');
    }else if( scroll>part5){
        $('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
        $('div#Menu>div>div.containerOptions>ul>li>a.contactenos').addClass('active');
    }
}


var resizeTimer;

$(window).on('resize', function(e) {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
      var containerOptions=$("div#Menu>div>div.containerOptions");
      var containerSession=$('div#Menu>div>a.containerSession');
      $(".hamburger").addClass('is-active');
      containerOptions.show();
      containerSession.show();
  }, 500);
});

/*MENU*/
$(".hamburger").click(function(){
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
});

$("div#Menu").mouseenter(function() {
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
}).mouseleave(function() {
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
});

$('div#Menu>div>div.containerOptions>ul>li>a').click(function(e){
    if (!$(this).hasClass('active')) {
        if (!$(this).hasClass('directLink')) {
            e.preventDefault();
            $('div#Menu>div>div.containerOptions>ul>li>a').removeClass('active');
            if ($(window).width() < 768) {
                if ($('div#menu').is(":visible")) {
                  $("div#menu").slideUp(500);
                  $(".hamburger").removeClass("is-active");
                }
            }
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                      scrollTop: target.offset().top
                    }, 850);
                    $(this).addClass('active');
                    return false;
                }
            }
        }
    }
});