$(document).ready(function() {
	$.material.init();
	$.stellar({
		horizontalScrolling: false,
		verticalOffset: 0
	});

	$('body').scrollspy();
	$('a').smoothScroll();
	Pace.once("done", function(){
		$('body').css("overflow", "auto");
		$('#header img').css("visibility", "visible").addClass("animated fadeInDown");
		$('.layer-1').css("visibility", "visible").addClass("animated fadeInUp");
		$('.layer-2').css("visibility", "visible").addClass("animated zoomInUp bat-animate");
		$('.layer-star').css("visibility", "visible").addClass("animated fadeInUp");
	});
});

$(function(){
	var showPosition = $('#description').offset().top;
	var subject = $('#subject').offset().top;
	$(window).scroll(function(){
		if( $(window).scrollTop() >= showPosition ) {
			$('.navbar').css({position: 'fixed', top: '0px', width:'100%'});
			$('.navbar').fadeIn();
		} else {
			$('.navbar').css({position: 'fixed', top: '0px'});
			$('.navbar').fadeOut();
		}

		if( $(window).scrollTop() >= subject - 200) {
			$('.subject-badge img').css("visibility", "visible").addClass("animated zoomIn");
			$('.subject-badge-xs img').css("visibility", "visible").addClass("animated zoomIn");

		}
	});
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$('.nav a').on('click', function(){
			$(".navbar-toggle").click()
		});
	}
	
});
