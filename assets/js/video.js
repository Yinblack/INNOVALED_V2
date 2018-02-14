var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '350',
    width: '555',
    videoId: '_uu59cvzB5w',
    playerVars: {
      'autoplay': 0, 
      'controls': 0,
      'color': 'white',
      'showinfo': 0,
      'rel': 0
    },
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}
function onPlayerReady(event) {
  event.target;
}
function onPlayerStateChange(event) {
  if (event.data==2 || event.data==0) {
    pauseVideo();
    estatus.show();
  }
}
function stopVideo() {
  player.stopVideo();
}
function pauseVideo() {
  player.pauseVideo();
}
function playVideo() {
  player.playVideo();
}


var estatus=$('div#status');
$("svg#Play").click(function(e){
  e.preventDefault();
  playVideo();
  estatus.hide();
});