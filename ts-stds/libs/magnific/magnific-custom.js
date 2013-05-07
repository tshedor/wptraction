jQuery(document).ready(function ($) {
	$(".gallery").magnificPopup({
		mainClass: "mfp-zoom-in",
		removalDelay: 300,
		delegate: "a",
		type: "image",
		tLoading: "Loading image #%curr%...",
		gallery: {
			enabled:true,
			navigateByImgClick:true,
			preload: [0, 1]
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: 'alt'
		}
	});
	$('p a[href*=".jpg"], p a[href*=".png"], p a[href*=".jpeg"]').magnificPopup({
		type: "image",
		closeOnContentClick:true,
		mainClass: "mfp-zoom-in",
		removalDelay: 300,
		image: {
			verticalFit:true,
			titleSrc: 'alt'
		}
	})
});