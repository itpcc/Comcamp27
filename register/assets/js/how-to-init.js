(function($){
  $(function(){
  	if(typeof $('#menu-option').pushpin == "function") 
      $('#menu-option').pushpin({ top: $('#menu-option').offset().top });
  	$(".parallax-container:not(.no-bg):has(.parallax img[src])").each(function(){
  		$(this).css('background-image', 'url("'+$(this).find(".parallax img[src]").attr("src")+'")');
  	});
    $('.button-collapse').sideNav();
    $('.parallax').parallax();
    if(typeof $(".animsition").animsition == "function"){
      $(".animsition").animsition();
    }else{
      $(".animsition").show();
    }
    $(".dropdown-button").dropdown({ hover: false, constrain_width: false });

  }); // end of document ready
})(jQuery); // end of jQuery name space