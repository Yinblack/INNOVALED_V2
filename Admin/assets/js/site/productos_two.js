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
  $('#contentTabs').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: false,
    draggable: false
  });
    $('#slideBanners').slick({
    arrows: true,
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    autoplay: true,
    pauseOnHover: false,
    timeout: 4000,
    autoplaySpeed: 4000
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

$('.scrollTo').click(function(e){
	e.preventDefault();
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
   	  	var target = $(this.hash);
   	  	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
   	  	if (target.length) {
   	  	  	$('html, body').animate({
   	  	  	  scrollTop: target.offset().top
   	  	  	}, 800);
   	  	  	return false;
   	  	}
   	}
});
