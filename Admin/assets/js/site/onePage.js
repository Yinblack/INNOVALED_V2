$(document).ready(function(){
    $(".main").onepage_scroll({
      sectionContainer: "section",
      responsiveFallback: 920,
      pagination: false, 
      loop: false,
      beforeMove: function(index) {
        $("div.containerOptions a").removeClass('active');
        $("div.containerOptions a."+index).addClass('active');
      }
    });
});