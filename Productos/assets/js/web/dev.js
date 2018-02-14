var base_url;
window.base_url = "https://www.innovaled.pe/";
var tabPosition;
window.tabPosition = 0;

/*FUNCTIONS ON READY*/
$( document ).ready(function() {
  $('.modal-success').iziModal({
    headerColor: '#030463',
    width: 400,
    timeout: 10000,
    pauseOnHover: true,
    timeoutProgressbar: true,
    attached: 'bottom'
  });
  $('#Slide').parallax();
  checkMenuType();
  window.sr = ScrollReveal({ duration: 1000 }).reveal('.reveal');
  autoSize();
  $( '#sliderVehiculo' ).sliderPro({
    width: "100%",
    height: 500,
    orientation: 'vertical',
    loop: false,
    arrows: false,
    buttons: false,
    thumbnailsPosition: 'left',
    thumbnailPointer: true,
    thumbnailWidth: 150,
    thumbnailHeight: 150,
    autoplay: false
  });
  $('#contentTabs').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false
  });
  $('.slide_sublineas').slick({
    slidesToShow: 6,
    slidesToScroll: 6,
    infinite: false,
    autoplay: true,
    arrows: true,
    dots: true,
    autoplay: false,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

});

function autoSize(){
      if ($(window).width()>768) {
        setTimeout(function()
        {
            var height=$("section#menuSection").height();
            $("section#menuSectionFix").height(height);
        }, 250);
      }
}

$('input.Style1').change(function() {
  if ($(this).val()) {
    $(this).next('span.placeholder').addClass('active');
  }else{
    $(this).next('span.placeholder').removeClass('active');
  }
});

/*STYLES AND SCRIPTS ON LOAD*/
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



/*FUNCTIONS ONCLICK*/
$('.scrollTo').click(function(e){
   	$( ".scrollTo" ).each(function() {
	 	$(this).removeClass('active');
	});
	$(this).addClass('active');
	if ($('section#menuSection.movil').is(":visible")) {
		$("section#menuSection").slideUp(500);
		$(".hamburger").removeClass("is-active");
	}
	e.preventDefault();
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
   	  	var target = $(this.hash);
   	  	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
   	  	if (target.length) {
   	  	  	$('html, body').animate({
   	  	  	  scrollTop: target.offset().top-50
   	  	  	}, 800);
   	  	  	return false;
   	  	}
   	}
});

$(window).scroll(function() {
  var $this = $(this);
  if ($this.scrollTop() > 0) {
         $('section#menuSection ul.menu a.Button1').addClass('show');
      }else{
         $('section#menuSection ul.menu a.Button1').removeClass('show');
      }
});

$(".hamburger").click(function(){
    $(this).toggleClass("is-active");
    if ($( this ).hasClass( "is-active" )) {
      $("section#menuSection").slideDown(500);
    }else{
      $("section#menuSection").slideUp(500);
    }
});

$("section#Quote a.tabPer").click(function(e){
  e.preventDefault();
  if (!$(this).hasClass('active')) {
    $("section#Quote a.tabPer").removeClass('active');
    var number =$(this).attr('href');
    $(this).addClass('active');
    $('#contentTabs').slick('slickGoTo', number);
  }
});

$("section#Quote a.changeTab").click(function(e){
  e.preventDefault();
  var index=$(this).attr('toTab');
  $('#contentTabs').slick('slickGoTo', index);
  $("a.tabPer").removeClass('active');
  $("a.tabPer.tab"+index).addClass('active');
});

$("section#Quote a.arrow").click(function(e){
  e.preventDefault();
  if ($(this).hasClass('left')) {
    if (window.tabPosition>0) {
      window.tabPosition=window.tabPosition-1;
    }
  }else if ($(this).hasClass('right')) {
    if (window.tabPosition<3) {
      window.tabPosition=window.tabPosition+1;
    }
  }
  $('#contentTabs').slick('slickGoTo', window.tabPosition);
  $("a.tabPer").removeClass('active');
  $("a.tabPer.tab"+window.tabPosition).addClass('active');
});




$("a.inputHt1").click(function(e){
  e.preventDefault();
  $("a.inputHt1").removeClass('active');
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
  }
});
$("a.inputHt2").click(function(e){
  e.preventDefault();
  $("a.inputHt2").removeClass('active');
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
  }
});
$("a.inputHt3").click(function(e){
  e.preventDefault();
  $("a.inputHt3").removeClass('active');
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
  }
});
$("a.inputHt4").click(function(e){
  e.preventDefault();
  $("a.inputHt4").removeClass('active');
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
  }
});
$("a.inputHt5").click(function(e){
  e.preventDefault();
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(this).next('input').prop('checked', false);
  }else{
    $(this).addClass('active');
    $(this).next('input').prop('checked', true);
  }
});


/*FUNCTION ON RESIZE*/
$(window).resize(function(){
	checkMenuType();
});

function checkMenuType(){
  var sizeWidhtWindow=$(window).width();
	if (sizeWidhtWindow <= 780) {
		$("section#menuSection").addClass('movil');
	}else{
		$("section#menuSection").removeClass('movil');
    $('section#menuSection').removeAttr('style');
	}
}

$("a.Submit").click(function(e){
  e.preventDefault();
  var formId = $(this).attr('form');
  var form=$("#"+formId);
  if ($(form).valid()) {
    sendContacto(form);
    console.log('valido');
  }else{
    console.log('no es valido');
  }
});



$( document ).ready(function() {
  $("#ContactForm").validate({
    errorPlacement: function(error, element) {
        error.insertBefore(element);
    },
    rules: {
      "nombre":     {
      required :true
      },
      "correo":     {
      required :true,
      email: true
      },
      "telefono":     {
        required :true,
        number: true,
        maxlength: 16,
        minlength: 8
      },
      "mensaje":     {
      required :true
      }
    },
    messages: {
      "nombre":     {
      required :"Este campo es obligatorio."
      },
      "correo":     {
      required :"Este campo es obligatorio.",
      email :"El Email no es valido."
      },
      "telefono":     {
        required :"Este campo es obligatorio.",
        number:"Numero de telefono no valido",
        maxlength:"Numero demasiado largo",
        minlength:"Numero demasiado corto"
      },
      "mensaje":     {
      required :"Este campo es obligatorio."
      }
    }
  });
});

function sendContacto(form){
  var formData = new FormData($(form)[0]);
    $.ajax({
        url: window.base_url+'WebPage_c/sendContacto',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success') {
            $('.modal-success').iziModal('open');
            $(form)[0].reset();
            setTimeout(function()
            {
              $('.modal-success').iziModal('close');
            }, 5000);
          }else{
            console.log('error');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}


function goBack() {
    window.history.back();
}
