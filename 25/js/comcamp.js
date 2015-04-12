$(document).ready( onDOMReady );
function onDOMReady() {
<!-- THEME RANDOM -->
var theme = Math.floor((Math.random()*7)+1);
switch (theme) {
case 2:
	$('.navbar-inner').css('background-color', '#734564');
	$('#head-strip-1').css('background-color', '#734564');
	$('#head-strip-2').css('background-color', '#97404e');
	$('#head-strip-3').css('background-color', '#a4aa49');
	$('h1').css('color', '#97404e');
	$('h2').css('color', '#97404e');
	$('#big-logo-img').attr('src','img/logo-dark-bg.png');
	break;
case 3:
	$('.navbar-inner').css('background-color', '#68d9b8');
	$('#head-strip-1').css('background-color', '#68d9b8');
	$('#head-strip-2').css('background-color', '#b8e061');
	$('#head-strip-3').css('background-color', '#e2dc69');
	$('h1').css('color', '#68d9b8');
	$('h2').css('color', '#68d9b8');
	break;
case 4:
	$('.navbar-inner').css('background-color', '#b5d80f');
	$('#head-strip-1').css('background-color', '#b5d80f');
	$('#head-strip-2').css('background-color', '#999ad8');
	$('#head-strip-3').css('background-color', '#c63278');
	$('h1').css('color', '#c63278');
	$('h2').css('color', '#c63278');
	break;
case 5:
	$('.navbar-inner').css('background-color', '#be1aca');
	$('#head-strip-1').css('background-color', '#be1aca');
	$('#head-strip-2').css('background-color', '#e7296f');
	$('#head-strip-3').css('background-color', '#9933ff');
	$('h1').css('color', '#e7296f');
	$('h2').css('color', '#e7296f');
	$('#big-logo-img').attr('src','img/logo-dark-bg.png');
	break;
case 6:
	$('.navbar-inner').css('background-color', '#d95b43');
	$('#head-strip-1').css('background-color', '#d95b43');
	$('#head-strip-2').css('background-color', '#d80f51');
	$('#head-strip-3').css('background-color', '#d1a530');
	$('h1').css('color', '#d80f51');
	$('h2').css('color', '#d80f51');
	$('#big-logo-img').attr('src','img/logo-dark-bg.png');
	break;
case 7:
	$('.navbar-inner').css('background-color', '#bddb6a');
	$('#head-strip-1').css('background-color', '#bddb6a');
	$('#head-strip-2').css('background-color', '#faae4c');
	$('#head-strip-3').css('background-color', '#f84b9b');
	$('h1').css('color', '#f84b9b');
	$('h2').css('color', '#f84b9b');
	break;
}
Cufon.replace('h1');
Cufon.replace('h2');
Cufon.replace('.jFormPageTitle');
}