$(function(){
  $("#modal-youtube").iziModal({
    history: false,
    iframe : true,
    fullscreen: true,
    headerColor: '#000000',
    iframeURL: 'https://www.youtube.com/embed/ZevL_ascLVo?autoplay=1&showinfo=0&controls=0',
    title: 'Innovaled - Sobre Nosotros',
    loop: true
  });
})

$("svg#playIcon").click(function(){
	$('#modal-youtube').iziModal('open');
});
