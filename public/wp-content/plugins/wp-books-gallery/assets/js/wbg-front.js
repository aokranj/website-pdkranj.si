(function(window, $) {

	// USE STRICT
	"use strict";
	
	$('.wbg-view-slide').slick({
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		infinite: true,
		autoplaySpeed: 3000,
		cssEase: 'ease',
		dots: false,
		dotsClass: 'slick-dots',
		pauseOnHover: true,
		arrows: true,
		prevArrow: '<button type="button" data-role="none" class="slick-prev">Previous</button>',
		responsive: [
			{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				dots: false
			}
			},
			{
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
			},
			{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
			}
		],
	});

})(window, jQuery);