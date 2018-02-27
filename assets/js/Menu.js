/*MENU AUTO*/
$(window).scroll(function (event) {
	statusMenu();
});

function statusMenu(){
    var scroll = $(window).scrollTop();
    var position1 = $('section#Home').position();
    var part1 = position1.top;
    var part2 = part1+$('section#Home').height();

    var x=$('section#Servicios_2').position();
    var y=x.top;
    var part3=y+$('section#Servicios_2').height();
    
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