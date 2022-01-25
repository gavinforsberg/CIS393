/* Control sliding menu on screens smaller than a specified breakpoint */
(function(menu_button, links, breakpoint) {
	'use strict';
	var menulink = document.getElementById(menu_button),
	    menu = document.getElementById(links);
		
	menu.className = 'start';
	setTimeout(function() {
		menu.className = 'collapsed';
	}, 20);
		
	menulink.onclick = function() {
		if (menu.className === 'displayed') {
			menu.className = 'collapsed';
		} else {
			menu.className = 'displayed';
		}
		return false;
	};
	
	window.onresize = function() {
		if (window.innerWidth < breakpoint) {
			menu.className = 'collapsed';
		}
	};	
	
	
})('menulink', 'navlinks', 700);


var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}