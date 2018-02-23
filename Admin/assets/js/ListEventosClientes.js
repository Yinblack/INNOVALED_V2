//$( "div.heightAuto" ).each(function() {
// 	
//});



$(function() {
	var maxHeight = Math.max.apply(null, $("div.heightAuto").map(function ()
	{
	    return $(this).height();
	}).get());
	$( "div.heightAuto" ).css('height',maxHeight);
});